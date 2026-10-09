<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;

final class GetActivityLogsForSubject
{
    public function execute(string $subjectType, int|string $subjectId): Builder
    {
        return ActivityLog::query()
            ->where('subject_type', $subjectType)
            ->where('subject_id', $subjectId)
            ->with('user')
            ->latest('created_at');
    }
}