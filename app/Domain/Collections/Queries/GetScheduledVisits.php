<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetScheduledVisits
{
    public function execute(): Builder
    {
        return Visit::query()
            ->where('status', 'scheduled')
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderBy('scheduled_at');
    }
}