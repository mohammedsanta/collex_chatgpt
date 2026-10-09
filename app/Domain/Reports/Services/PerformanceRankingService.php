<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Reports\Models\PerformanceSnapshot;

final class PerformanceRankingService
{
    public function rank(int $bankId, int $year, int $month): array
    {
        return PerformanceSnapshot::query()
            ->where('bank_id', $bankId)
            ->where('year', $year)
            ->where('month', $month)
            ->orderByDesc('efficiency')
            ->pluck('user_id')
            ->values()
            ->mapWithKeys(
                fn ($userId, $index) => [$userId => $index + 1]
            )
            ->all();
    }
}