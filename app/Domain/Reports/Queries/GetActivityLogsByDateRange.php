<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;

final class GetActivityLogsByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return ActivityLog::query()
            ->whereBetween('created_at', [$from, $to])
            ->with('user')
            ->latest('created_at');
    }
}