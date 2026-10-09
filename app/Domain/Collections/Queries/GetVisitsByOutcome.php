<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByOutcome
{
    public function execute(string $outcome): Builder
    {
        return Visit::query()
            ->where('outcome', $outcome)
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->latest('scheduled_at');
    }
}