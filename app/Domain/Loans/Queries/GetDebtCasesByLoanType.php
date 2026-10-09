<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByLoanType
{
    public function execute(int $loanTypeId): Builder
    {
        return DebtCase::query()
            ->where('loan_type_id', $loanTypeId)
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->latest('created_at');
    }
}