<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;

final class GetActivityLogsByEvent
{
    public function execute(string $event): Builder
    {
        return ActivityLog::query()
            ->where('event', $event)
            ->with('user')
            ->latest('created_at');
    }
}