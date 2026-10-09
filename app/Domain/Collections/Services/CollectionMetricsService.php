<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Models\Payment;

final class CollectionMetricsService
{
    public function collectedAmount(DebtCase $case): float
    {
        return (float) Payment::query()
            ->where('debt_case_id', $case->id)
            ->where('status', 'confirmed')
            ->sum('amount');
    }

    public function collectionRate(DebtCase $case): float
    {
        if ((float) $case->total_debt <= 0) {
            return 0.0;
        }

        return round(
            ($this->collectedAmount($case) / (float) $case->total_debt) * 100,
            2
        );
    }
}