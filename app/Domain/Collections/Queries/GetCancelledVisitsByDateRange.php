<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetCancelledVisitsByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return Visit::query()
            ->where('status', 'cancelled')
            ->whereBetween('scheduled_at', [$from, $to])
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderByDesc('scheduled_at');
    }
}