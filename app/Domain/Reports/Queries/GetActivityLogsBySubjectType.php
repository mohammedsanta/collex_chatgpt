<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;

final class GetActivityLogsBySubjectType
{
    public function execute(string $subjectType): Builder
    {
        return ActivityLog::query()
            ->where('subject_type', $subjectType)
            ->with('user')
            ->latest('created_at');
    }
}