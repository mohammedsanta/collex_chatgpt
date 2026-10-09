<?php

declare(strict_types=1);

namespace App\Domain\Payments\Services;

use App\Domain\Payments\Models\Payment;

final class PaymentStatusService
{
    public function isPending(Payment $payment): bool
    {
        return $payment->status === 'pending';
    }

    public function isConfirmed(Payment $payment): bool
    {
        return $payment->status === 'confirmed';
    }

    public function isRejected(Payment $payment): bool
    {
        return $payment->status === 'rejected';
    }
}