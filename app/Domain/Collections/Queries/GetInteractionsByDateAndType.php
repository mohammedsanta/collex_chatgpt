<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetInteractionsByDateAndType
{
    public function execute(string $date, string $type): Builder
    {
        return CaseInteraction::query()
            ->whereDate('occurred_at', $date)
            ->where('type', $type)
            ->with(['debtCase.client', 'user', 'clientPhone'])
            ->orderByDesc('occurred_at');
    }
}