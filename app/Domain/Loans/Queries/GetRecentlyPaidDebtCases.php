<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetRecentlyPaidDebtCases
{
    public function execute(int $days = 30): Builder
    {
        return DebtCase::query()
            ->whereNotNull('last_payment_date')
            ->where('last_payment_date', '>=', now()->subDays($days))
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderByDesc('last_payment_date');
    }
}