<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePayment
{
    public function execute(
        Payment $payment,
        array $data
    ): Payment {
        try {
            return DB::transaction(function () use (
                $payment,
                $data
            ): Payment {
                $payment = Payment::query()
                    ->lockForUpdate()
                    ->findOrFail($payment->getKey());

                if ($payment->status !== 'pending') {
                    throw new \App\Exceptions\DomainException(
                        'Only pending payments can be updated.'
                    );
                }

                $payment->update([
                    'amount' => $data['amount'] ?? $payment->amount,
                    'method' => $data['method'] ?? $payment->method,
                    'reference' => $data['reference']
                        ?? $payment->reference,
                    'proof_path' => $data['proof_path']
                        ?? $payment->proof_path,
                    'paid_at' => $data['paid_at'] ?? $payment->paid_at,
                    'notes' => $data['notes'] ?? $payment->notes,
                ]);

                return $payment->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update payment.', [
                'action' => self::class,
                'payment_id' => $payment->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}