<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;

final class OverdueAmountCalculator
{
    public function calculate(DebtCase $debtCase): float
    {
        return max(
            0,
            (float) $debtCase->overdue_amount
            + (float) $debtCase->late_fee
        );
    }
}