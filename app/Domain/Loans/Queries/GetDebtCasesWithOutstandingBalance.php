<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithOutstandingBalance
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereColumn('collected_amount', '<', 'total_debt')
            ->whereIn('status', ['active', 'legal'])
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderByDesc('total_debt');
    }
}