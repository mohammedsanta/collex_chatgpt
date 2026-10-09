<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByAssignee
{
    public function execute(int $userId): Builder
    {
        return Complaint::query()
            ->where('assigned_to', $userId)
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
            ])
            ->orderBy('due_at');
    }
}