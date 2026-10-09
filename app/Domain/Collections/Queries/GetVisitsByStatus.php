<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByStatus
{
    public function execute(string $status): Builder
    {
        return Visit::query()
            ->where('status', $status)
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}