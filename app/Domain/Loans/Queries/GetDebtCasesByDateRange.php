<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return DebtCase::query()
            ->whereBetween('created_at', [$from, $to])
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