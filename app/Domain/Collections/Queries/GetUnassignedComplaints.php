<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetUnassignedComplaints
{
    public function execute(): Builder
    {
        return Complaint::query()
            ->whereNull('assigned_to')
            ->whereIn('status', ['open', 'in_review'])
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
            ])
            ->orderBy('priority')
            ->orderBy('due_at');
    }
}