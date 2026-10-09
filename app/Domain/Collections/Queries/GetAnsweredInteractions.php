<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetAnsweredInteractions
{
    public function execute(): Builder
    {
        return CaseInteraction::query()
            ->where('outcome', 'answered')
            ->with([
                'debtCase.client',
                'user',
                'clientPhone',
            ])
            ->orderByDesc('occurred_at');
    }
}