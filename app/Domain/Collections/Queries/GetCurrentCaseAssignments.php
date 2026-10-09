<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Database\Eloquent\Builder;

final class GetCurrentCaseAssignments
{
    public function execute(): Builder
    {
        return CaseAssignment::query()
            ->whereNull('unassigned_at')
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'user',
                'assignedBy',
            ])
            ->latest('assigned_at');
    }
}