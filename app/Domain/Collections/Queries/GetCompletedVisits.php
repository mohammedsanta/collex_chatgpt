<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetCompletedVisits
{
    public function execute(): Builder
    {
        return Visit::query()
            ->where('status', 'completed')
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderByDesc('visited_at');
    }
}