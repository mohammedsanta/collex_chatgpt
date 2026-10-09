<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetInteractionsByUserAndDateRange
{
    public function execute(
        int $userId,
        string $from,
        string $to
    ): Builder {
        return CaseInteraction::query()
            ->where('user_id', $userId)
            ->whereBetween('occurred_at', [$from, $to])
            ->with([
                'debtCase.client',
                'user',
                'clientPhone',
            ])
            ->orderByDesc('occurred_at');
    }
}