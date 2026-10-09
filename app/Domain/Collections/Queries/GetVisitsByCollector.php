<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByCollector
{
    public function execute(int $userId): Builder
    {
        return Visit::query()
            ->where('user_id', $userId)
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}