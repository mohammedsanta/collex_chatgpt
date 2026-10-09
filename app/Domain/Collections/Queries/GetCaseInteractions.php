<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetCaseInteractions
{
    public function execute(int $debtCaseId): Builder
    {
        return CaseInteraction::query()
            ->where('debt_case_id', $debtCaseId)
            ->with([
                'user',
                'clientPhone',
            ])
            ->orderByDesc('occurred_at');
    }
}