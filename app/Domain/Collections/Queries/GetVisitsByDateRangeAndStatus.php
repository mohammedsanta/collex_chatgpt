<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByDateRangeAndStatus
{
    public function execute(
        string $from,
        string $to,
        string $status
    ): Builder {
        return Visit::query()
            ->whereBetween('scheduled_at', [$from, $to])
            ->where('status', $status)
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}