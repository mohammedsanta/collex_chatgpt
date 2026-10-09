<?php

declare(strict_types=1);

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Models\Payment;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePayment
{
    /** @param array<string, mixed> $data */
    public function execute(Payment $payment, array $data): Payment
    {
        try {
            return DB::transaction(function () use ($payment, $data): Payment {
                $locked = Payment::query()->lockForUpdate()->findOrFail($payment->getKey());
                if ($locked->status !== 'pending') {
                    throw new DomainException('Only pending payments can be edited.', 'PAYMENT_NOT_PENDING');
                }
                $allowed = array_intersect_key($data, array_flip(['debt_case_id','collector_id','promise_id','amount','method','reference','proof_path','paid_at','notes']));
                $locked->update($allowed);
                return $locked->refresh();
            });
        } catch (Throwable $exception) {
            Log::error('Failed to update payment.', ['payment_id' => $payment->getKey(), 'exception' => $exception]);
            throw $exception;
        }
    }
}
