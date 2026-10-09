<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByPriorityRange
{
    public function execute(array $priorities): Builder
    {
        return Complaint::query()
            ->whereIn('priority', $priorities)
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