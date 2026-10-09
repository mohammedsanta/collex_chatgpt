<?php

namespace App\Domain\Payments\Services;

use App\Domain\Loans\Models\DebtCase;

final class PaymentBalanceService
{
    public function remaining(DebtCase $case): float
    {
        return max(
            0,
            (float) $case->total_debt - (float) $case->collected_amount
        );
    }
}