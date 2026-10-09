<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Database\Eloquent\Builder;

final class GetPerformanceSnapshotsByPeriod
{
    public function execute(int $year, int $month): Builder
    {
        return PerformanceSnapshot::query()
            ->where('year', $year)
            ->where('month', $month)
            ->with([
                'user',
                'bank',
            ])
            ->orderBy('rank_position');
    }
}