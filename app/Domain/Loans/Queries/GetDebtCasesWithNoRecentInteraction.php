<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithNoRecentInteraction
{
    public function execute(int $days = 7): Builder
    {
        $since = now()->subDays($days);

        return DebtCase::query()
            ->whereIn('status', ['active', 'legal'])
            ->whereDoesntHave(
                'interactions',
                fn (Builder $query) => $query->where('occurred_at', '>=', $since)
            )
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderByDesc('overdue_amount');
    }
}