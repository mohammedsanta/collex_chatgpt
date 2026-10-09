<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByAssigneeAndStatus
{
    public function execute(int $userId, string $status): Builder
    {
        return Complaint::query()
            ->where('assigned_to', $userId)
            ->where('status', $status)
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->orderByDesc('priority')
            ->orderBy('due_at');
    }
}