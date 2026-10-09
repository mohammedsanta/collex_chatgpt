<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Database\Eloquent\Builder;

final class GetUnassignedCaseHistory
{
    public function execute(): Builder
    {
        return CaseAssignment::query()
            ->whereNotNull('unassigned_at')
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderByDesc('unassigned_at');
    }
}