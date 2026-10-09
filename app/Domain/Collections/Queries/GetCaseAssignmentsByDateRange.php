<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Database\Eloquent\Builder;

final class GetCaseAssignmentsByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return CaseAssignment::query()
            ->whereBetween('assigned_at', [$from, $to])
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderByDesc('assigned_at');
    }
}