<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeletePayment
{
    public function execute(Payment $payment): void
    {
        try {
            DB::transaction(function () use ($payment): void {
                $payment = Payment::query()
                    ->lockForUpdate()
                    ->findOrFail($payment->getKey());

                if ($payment->status !== 'pending') {
                    throw new \App\Exceptions\DomainException(
                        'Only pending payments can be deleted.'
                    );
                }

                $payment->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete payment.', [
                'action' => self::class,
                'payment_id' => $payment->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}