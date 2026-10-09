<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByStatus
{
    public function execute(string $status): Builder
    {
        return Complaint::query()
            ->where('status', $status)
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->orderByDesc('created_at');
    }
}