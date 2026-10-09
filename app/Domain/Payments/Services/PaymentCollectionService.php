<?php

namespace App\Domain\Payments\Services;

use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Models\Payment;

final class PaymentCollectionService
{
    public function confirmedTotal(DebtCase $case): float
    {
        return (float) $case->payments()
            ->where('status', 'confirmed')
            ->sum('amount');
    }

    public function confirmed(Payment $payment): bool
    {
        return $payment->status === 'confirmed';
    }
}