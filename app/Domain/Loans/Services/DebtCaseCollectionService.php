<?php

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;

final class DebtCaseCollectionService
{
    public function remainingBalance(DebtCase $case): float
    {
        return max(
            0,
            (float) $case->total_debt - (float) $case->collected_amount
        );
    }

    public function collectionPercentage(DebtCase $case): float
    {
        if ((float) $case->total_debt <= 0) {
            return 0;
        }

        return round(
            ((float) $case->collected_amount / (float) $case->total_debt) * 100,
            2
        );
    }
}