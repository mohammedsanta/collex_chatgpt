<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByOverdueAmount
{
    public function execute(float $minimumAmount): Builder
    {
        return DebtCase::query()
            ->where('overdue_amount', '>=', $minimumAmount)
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