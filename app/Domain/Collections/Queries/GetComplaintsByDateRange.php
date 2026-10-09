<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return Complaint::query()
            ->whereBetween('created_at', [$from, $to])
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