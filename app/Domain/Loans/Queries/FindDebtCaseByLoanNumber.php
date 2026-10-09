<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;

final class FindDebtCaseByLoanNumber
{
    public function execute(string $loanNumber): ?DebtCase
    {
        return DebtCase::query()
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->where('loan_number', $loanNumber)
            ->first();
    }
}