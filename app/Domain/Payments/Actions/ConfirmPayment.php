<?php

declare(strict_types=1);

namespace App\Domain\Payments\Actions;

use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Activity\Services\ActivityLogger;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Services\DebtCaseBalanceService;
use App\Domain\Payments\Models\Payment;
use App\Domain\Payments\Services\PaymentConfirmationService;
use App\Domain\Payments\Services\PaymentAmountCalculator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ConfirmPayment
{
    public function __construct(
        private readonly PaymentConfirmationService $confirmationService,
        private readonly DebtCaseBalanceService $balanceService,
        private readonly ActivityLogger $activityLogger,
        private readonly PaymentAmountCalculator $amountCalculator,
    ) {}

    public function execute(Payment $payment, int $confirmedBy): Payment
    {
        try {
            return DB::transaction(function () use ($payment, $confirmedBy): Payment {
                $lockedPayment = Payment::query()->lockForUpdate()->findOrFail($payment->getKey());
                $this->confirmationService->ensureCanBeConfirmed($lockedPayment);

                $lockedCase = DebtCase::query()->lockForUpdate()->findOrFail($lockedPayment->debt_case_id);
                $lockedCase = $this->balanceService->refreshCollectedAmount($lockedCase);
                if ($this->amountCalculator->exceedsRemainingBalance($lockedCase, (string) $lockedPayment->amount)) {
                    throw new \App\Exceptions\DomainException(
                        'Payment amount exceeds the remaining debt balance.',
                        'PAYMENT_EXCEEDS_REMAINING_BALANCE',
                    );
                }

                $lockedPayment->update([
                    'status' => 'confirmed',
                    'confirmed_by' => $confirmedBy,
                    'confirmed_at' => now(),
                    'rejection_reason' => null,
                ]);

                $this->balanceService->refreshCollectedAmount($lockedCase);
                $this->refreshLastPaymentMetadata($lockedCase);

                if ($lockedPayment->promise_id !== null) {
                    $promise = PromiseToPay::query()->lockForUpdate()->find($lockedPayment->promise_id);
                    if ($promise !== null && ! in_array($promise->status, ['kept', 'broken'], true)) {
                        $paidAmount = (float) $promise->payments()->where('status', 'confirmed')->sum('amount');
                        $promisedAmount = (float) $promise->promised_amount;
                        $promise->update([
                            'paid_amount' => $paidAmount,
                            'status' => $paidAmount >= $promisedAmount ? 'kept' : ($paidAmount > 0 ? 'partial' : 'active'),
                            'closed_at' => $paidAmount >= $promisedAmount ? now() : null,
                        ]);
                    }
                }

                $this->activityLogger->log(
                    userId: $confirmedBy,
                    event: 'payment.confirmed',
                    description: 'Payment confirmed.',
                    properties: ['amount' => (string) $lockedPayment->amount],
                    subject: $lockedPayment,
                );

                return $lockedPayment->refresh();
            });
        } catch (Throwable $exception) {
            Log::error('Failed to confirm payment.', [
                'payment_id' => $payment->getKey(),
                'confirmed_by' => $confirmedBy,
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }

    private function refreshLastPaymentMetadata(DebtCase $debtCase): void
    {
        $latest = $debtCase->payments()->where('status', 'confirmed')->orderByDesc('paid_at')->orderByDesc('id')->first();
        $debtCase->update([
            'last_payment_date' => $latest?->paid_at,
            'last_payment_amount' => $latest?->amount,
        ]);
    }
}
