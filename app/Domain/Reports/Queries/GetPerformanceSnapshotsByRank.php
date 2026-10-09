<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Database\Eloquent\Builder;

final class GetPerformanceSnapshotsByRank
{
    public function execute(int $year, int $month, int $maxRank): Builder
    {
        return PerformanceSnapshot::query()
            ->where('year', $year)
            ->where('month', $month)
            ->whereNotNull('rank_position')
            ->where('rank_position', '<=', $maxRank)
            ->with([
                'user',
                'bank',
            ])
            ->orderBy('rank_position');
    }
}