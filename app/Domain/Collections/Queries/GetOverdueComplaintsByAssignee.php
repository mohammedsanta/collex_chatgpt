<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetOverdueComplaintsByAssignee
{
    public function execute(int $userId): Builder
    {
        return Complaint::query()
            ->where('assigned_to', $userId)
            ->whereIn('status', ['open', 'in_review'])
            ->whereNotNull('due_at')
            ->where('due_at', '<', now())
            ->with([
                'bank',
                'debtCase.client',
                'assignedTo',
            ])
            ->orderBy('due_at');
    }
}