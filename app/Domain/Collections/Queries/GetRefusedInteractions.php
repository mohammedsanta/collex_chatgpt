<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetRefusedInteractions
{
    public function execute(): Builder
    {
        return CaseInteraction::query()
            ->where('outcome', 'refused')
            ->with([
                'debtCase.client',
                'user',
                'clientPhone',
            ])
            ->latest('occurred_at');
    }
}