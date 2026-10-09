<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Database\Eloquent\Builder;

final class GetCaseAssignmentsByUser
{
    public function execute(int $userId): Builder
    {
        return CaseAssignment::query()
            ->where('user_id', $userId)
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->latest('assigned_at');
    }
}