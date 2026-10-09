<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

final class GetVisitsByDateRange
{
    public function execute(
        Carbon $from,
        Carbon $to
    ): Builder {
        return Visit::query()
            ->whereBetween('scheduled_at', [$from, $to])
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}