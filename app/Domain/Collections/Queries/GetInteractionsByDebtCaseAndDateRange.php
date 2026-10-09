<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Database\Eloquent\Builder;

final class GetInteractionsByDebtCaseAndDateRange
{
    public function execute(
        int $debtCaseId,
        string $from,
        string $to
    ): Builder {
        return CaseInteraction::query()
            ->where('debt_case_id', $debtCaseId)
            ->whereBetween('occurred_at', [$from, $to])
            ->with([
                'debtCase',
                'user',
                'clientPhone',
            ])
            ->orderByDesc('occurred_at');
    }
}