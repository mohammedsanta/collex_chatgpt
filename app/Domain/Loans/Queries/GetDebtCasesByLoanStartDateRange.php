<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByLoanStartDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return DebtCase::query()
            ->whereBetween('loan_start_date', [$from, $to])
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderBy('loan_start_date');
    }
}