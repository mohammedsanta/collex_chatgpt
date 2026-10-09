<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetPaidDebtCases
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->where('status', 'paid')
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