<?php

namespace App\Domain\Payments\Services;

use App\Domain\Payments\Models\Payment;

final class PaymentProofService
{
    public function requiresProof(Payment $payment): bool
    {
        return in_array($payment->method, [
            'e_wallet',
            'bank_transfer',
            'card',
        ], true);
    }
}