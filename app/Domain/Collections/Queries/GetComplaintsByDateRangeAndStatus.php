<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByDateRangeAndStatus
{
    public function execute(
        string $from,
        string $to,
        string $status
    ): Builder {
        return Complaint::query()
            ->whereBetween('created_at', [$from, $to])
            ->where('status', $status)
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->latest('created_at');
    }
}