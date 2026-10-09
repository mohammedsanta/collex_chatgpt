<?php

declare(strict_types=1);

namespace App\Domain\Payments\Actions;

use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Models\Payment;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Activity\Services\ActivityLogger;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Domain\Payments\Services\PaymentReceiptNumberGenerator;
use App\Domain\Payments\Services\PaymentAmountCalculator;
use App\Domain\Loans\Services\DebtCaseBalanceService;
use Throwable;

final class CreatePayment
{
    public function __construct(
        private readonly PaymentReceiptNumberGenerator $receiptNumberGenerator,
        private readonly ActivityLogger $activityLogger,
        private readonly DebtCaseBalanceService $balanceService,
        private readonly PaymentAmountCalculator $amountCalculator,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data, ?int $createdBy = null): Payment
    {
        try {
            return DB::transaction(function () use ($data, $createdBy): Payment {
                $debtCase = DebtCase::query()->lockForUpdate()->findOrFail($data['debt_case_id']);
                if (! in_array($debtCase->status, ['active', 'legal'], true)) {
                    throw new DomainException('Payments can only be recorded against active or legal cases.', 'DEBT_CASE_NOT_COLLECTIBLE');
                }

                $debtCase = $this->balanceService->refreshCollectedAmount($debtCase);
                if ($this->amountCalculator->exceedsRemainingBalance($debtCase, $data['amount'])) {
                    throw new DomainException('Payment amount exceeds the remaining debt balance.', 'PAYMENT_EXCEEDS_REMAINING_BALANCE');
                }

                if (! empty($data['promise_id'])) {
                    $promise = PromiseToPay::query()->lockForUpdate()->findOrFail($data['promise_id']);
                    if ((int) $promise->debt_case_id !== (int) $debtCase->getKey()) {
                        throw new DomainException('The promise does not belong to the selected debt case.', 'PROMISE_CASE_MISMATCH');
                    }
                    if (in_array($promise->status, ['kept', 'broken'], true)) {
                        throw new DomainException('A closed promise cannot receive a new payment allocation.', 'PROMISE_CLOSED');
                    }
                }

                $payment = Payment::create([
                    'receipt_number' => $this->receiptNumberGenerator->generate(),
                    'debt_case_id' => $data['debt_case_id'],
                    'collector_id' => $data['collector_id'] ?? null,
                    'promise_id' => $data['promise_id'] ?? null,
                    'amount' => $data['amount'],
                    'method' => $data['method'],
                    'reference' => $data['reference'] ?? null,
                    'proof_path' => $data['proof_path'] ?? null,
                    'paid_at' => $data['paid_at'] ?? now(),
                    'status' => 'pending',
                    'confirmed_by' => null,
                    'confirmed_at' => null,
                    'rejection_reason' => null,
                    'notes' => $data['notes'] ?? null,
                ]);

                $this->activityLogger->log(
                    userId: $createdBy,
                    event: 'payment.created',
                    description: 'Payment recorded and awaiting confirmation.',
                    properties: ['amount' => (string) $payment->amount, 'method' => $payment->method],
                    subject: $payment,
                );

                return $payment;
            });
        } catch (Throwable $e) {
            Log::error('Failed to create payment.', [
                'action' => self::class,
                'debt_case_id' => $data['debt_case_id'] ?? null,
                'amount' => $data['amount'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

}
