<?php

declare(strict_types=1);

namespace App\Domain\Payments\Services;

use App\Domain\Payments\Models\Payment;
use App\Exceptions\DomainException;

final class PaymentConfirmationService
{
    public function ensureCanBeConfirmed(Payment $payment): void
    {
        if ($payment->status !== 'pending') {
            throw new DomainException('Only pending payments can be confirmed.', 'PAYMENT_NOT_PENDING');
        }

        if ((float) $payment->amount <= 0) {
            throw new DomainException('Payment amount must be greater than zero.', 'INVALID_PAYMENT_AMOUNT');
        }
    }
}
