<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetUpcomingVisitsByUser
{
    public function execute(int $userId): Builder
    {
        return Visit::query()
            ->where('user_id', $userId)
            ->where('status', 'scheduled')
            ->where('scheduled_at', '>=', now())
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}