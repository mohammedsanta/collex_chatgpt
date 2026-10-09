<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByPriority
{
    public function execute(string $priority): Builder
    {
        return Complaint::query()
            ->where('priority', $priority)
            ->whereIn('status', ['open', 'in_review'])
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
            ])
            ->orderBy('due_at')
            ->orderByDesc('created_at');
    }
}