<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsWithoutOutcome
{
    public function execute(): Builder
    {
        return Visit::query()
            ->whereNull('outcome')
            ->with(['debtCase.client', 'user'])
            ->orderBy('scheduled_at');
    }
}