<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetOverdueDebtCases
{
    public function execute(int $minimumDpd = 1): Builder
    {
        return DebtCase::query()
            ->where('status', 'active')
            ->where('dpd', '>=', $minimumDpd)
            ->where('overdue_amount', '>', 0)
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderByDesc('dpd')
            ->orderByDesc('overdue_amount');
    }
}