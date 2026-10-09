<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;

final class GetActivityLogsByUser
{
    public function execute(int $userId): Builder
    {
        return ActivityLog::query()
            ->where('user_id', $userId)
            ->latest('created_at');
    }
}