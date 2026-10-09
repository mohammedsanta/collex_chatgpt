<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisedInteractions
{
    public function execute(): Builder
    {
        return CaseInteraction::query()
            ->where('outcome', 'promised')
            ->with([
                'debtCase.client',
                'user',
                'clientPhone',
            ])
            ->latest('occurred_at');
    }
}