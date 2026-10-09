<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveDebtCases
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->where('status', 'active')
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