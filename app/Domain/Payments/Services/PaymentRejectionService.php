<?php

declare(strict_types=1);

namespace App\Domain\Payments\Services;

use App\Domain\Payments\Models\Payment;
use App\Exceptions\DomainException;

final class PaymentRejectionService
{
    public function ensureCanBeRejected(Payment $payment): void
    {
        if ($payment->status !== 'pending') {
            throw new DomainException('Only pending payments can be rejected.', 'PAYMENT_NOT_PENDING');
        }
    }
}
