<?php

declare(strict_types=1);

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Models\Payment;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeletePayment
{
    public function execute(Payment $payment): void
    {
        try {
            DB::transaction(function () use ($payment): void {
                $locked = Payment::query()->lockForUpdate()->findOrFail($payment->getKey());
                if ($locked->status !== 'pending') {
                    throw new DomainException('Only pending payments can be deleted.', 'PAYMENT_NOT_PENDING');
                }
                $locked->delete();
            });
        } catch (Throwable $exception) {
            Log::error('Failed to delete payment.', ['payment_id' => $payment->getKey(), 'exception' => $exception]);
            throw $exception;
        }
    }
}
