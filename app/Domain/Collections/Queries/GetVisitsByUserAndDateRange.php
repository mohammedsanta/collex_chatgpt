<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByUserAndDateRange
{
    public function execute(
        int $userId,
        string $from,
        string $to
    ): Builder {
        return Visit::query()
            ->where('user_id', $userId)
            ->whereBetween('scheduled_at', [$from, $to])
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}