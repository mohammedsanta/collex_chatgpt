<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetInteractionsByUser
{
    public function execute(int $userId): Builder
    {
        return CaseInteraction::query()
            ->where('user_id', $userId)
            ->with([
                'debtCase.client',
                'user',
                'clientPhone',
            ])
            ->orderByDesc('occurred_at');
    }
}