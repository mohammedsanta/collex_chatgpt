<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetInteractionsByBank
{
    public function execute(int $bankId): Builder
    {
        return CaseInteraction::query()
            ->whereHas('debtCase', function (Builder $query) use ($bankId): void {
                $query->where('bank_id', $bankId);
            })
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'user',
                'clientPhone',
            ])
            ->latest('occurred_at');
    }
}