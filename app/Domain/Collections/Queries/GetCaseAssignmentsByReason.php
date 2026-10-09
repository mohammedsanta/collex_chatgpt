<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Database\Eloquent\Builder;

final class GetCaseAssignmentsByReason
{
    public function execute(string $reason): Builder
    {
        return CaseAssignment::query()
            ->where('reason', 'like', "%{$reason}%")
            ->with(['debtCase.client', 'user', 'assignedBy'])
            ->latest('assigned_at');
    }
}