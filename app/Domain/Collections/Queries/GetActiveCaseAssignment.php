<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;

final class GetActiveCaseAssignment
{
    public function execute(int $debtCaseId): ?CaseAssignment
    {
        return CaseAssignment::query()
            ->where('debt_case_id', $debtCaseId)
            ->whereNull('unassigned_at')
            ->with([
                'user',
                'assignedBy',
                'debtCase',
            ])
            ->latest('assigned_at')
            ->first();
    }
}