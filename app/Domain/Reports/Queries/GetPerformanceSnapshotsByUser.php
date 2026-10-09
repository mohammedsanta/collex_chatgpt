<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Database\Eloquent\Builder;

final class GetPerformanceSnapshotsByUser
{
    public function execute(int $userId): Builder
    {
        return PerformanceSnapshot::query()
            ->where('user_id', $userId)
            ->with([
                'user',
                'bank',
            ])
            ->orderByDesc('year')
            ->orderByDesc('month');
    }
}