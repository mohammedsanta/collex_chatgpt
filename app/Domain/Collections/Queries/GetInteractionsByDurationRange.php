<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetInteractionsByDurationRange
{
    public function execute(int $minimum, int $maximum): Builder
    {
        return CaseInteraction::query()
            ->whereBetween('duration_seconds', [$minimum, $maximum])
            ->with(['debtCase.client', 'user'])
            ->orderByDesc('duration_seconds');
    }
}