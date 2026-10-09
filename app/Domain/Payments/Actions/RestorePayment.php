<?php

declare(strict_types=1);

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestorePayment
{
    public function execute(int $paymentId): Payment
    {
        try {
            return DB::transaction(function () use ($paymentId): Payment {
                $payment = Payment::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($paymentId);

                if (! $payment->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The payment is not deleted.'
                    );
                }

                $payment->restore();

                return $payment->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore payment.', [
                'action' => self::class,
                'payment_id' => $paymentId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}