<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetInteractionsWithFollowup
{
    public function execute(): Builder
    {
        return CaseInteraction::query()
            ->whereNotNull('followup_at')
            ->where('followup_at', '>=', now())
            ->with([
                'debtCase.client',
                'user',
                'clientPhone',
            ])
            ->orderBy('followup_at');
    }
}