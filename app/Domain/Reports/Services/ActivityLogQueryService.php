<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ActivityLogQueryService
{
    public function recent(int $perPage = 50): LengthAwarePaginator
    {
        return ActivityLog::query()
            ->latest('created_at')
            ->paginate($perPage);
    }
}