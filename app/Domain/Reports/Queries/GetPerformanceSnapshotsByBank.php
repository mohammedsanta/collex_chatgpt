<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Database\Eloquent\Builder;

final class GetPerformanceSnapshotsByBank
{
    public function execute(int $bankId): Builder
    {
        return PerformanceSnapshot::query()
            ->where('bank_id', $bankId)
            ->with([
                'user',
                'bank',
            ])
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->orderBy('rank_position');
    }
}