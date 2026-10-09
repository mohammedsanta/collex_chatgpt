<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Database\Eloquent\Builder;

final class GetCaseAssignmentHistory
{
    public function execute(int $debtCaseId): Builder
    {
        return CaseAssignment::query()
            ->where('debt_case_id', $debtCaseId)
            ->with([
                'user',
                'assignedBy',
            ])
            ->orderByDesc('assigned_at');
    }
}