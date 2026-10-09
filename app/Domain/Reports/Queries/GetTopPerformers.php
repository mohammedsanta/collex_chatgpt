<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Database\Eloquent\Builder;

final class GetTopPerformers
{
    public function execute(
        int $bankId,
        int $year,
        int $month,
        int $limit = 10
    ): Builder {
        return PerformanceSnapshot::query()
            ->where('bank_id', $bankId)
            ->where('year', $year)
            ->where('month', $month)
            ->with('user')
            ->orderBy('rank_position')
            ->limit($limit);
    }
}