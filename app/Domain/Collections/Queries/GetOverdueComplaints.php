<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetOverdueComplaints
{
    public function execute(): Builder
    {
        return Complaint::query()
            ->whereIn('status', ['open', 'in_review'])
            ->whereNotNull('due_at')
            ->where('due_at', '<', now())
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
            ])
            ->orderBy('due_at');
    }
}