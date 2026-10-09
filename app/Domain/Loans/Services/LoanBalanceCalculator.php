<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;

final class LoanBalanceCalculator
{
    public function remaining(DebtCase $debtCase): float
    {
        return max(
            0,
            (float) $debtCase->total_debt - (float) $debtCase->collected_amount
        );
    }
}