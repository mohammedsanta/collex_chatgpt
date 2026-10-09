<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetFullyCollectedDebtCases
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereColumn('collected_amount', '>=', 'total_debt')
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->latest('last_payment_date');
    }
}