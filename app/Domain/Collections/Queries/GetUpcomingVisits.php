<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetUpcomingVisits
{
    public function execute(int $days = 7): Builder
    {
        return Visit::query()
            ->where('status', 'scheduled')
            ->whereBetween('scheduled_at', [
                now(),
                now()->addDays($days),
            ])
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}