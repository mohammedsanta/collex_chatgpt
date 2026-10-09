<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByLoanNumber
{
    public function execute(string $loanNumber): Builder
    {
        return DebtCase::query()
            ->where('loan_number', $loanNumber)
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ]);
    }
}