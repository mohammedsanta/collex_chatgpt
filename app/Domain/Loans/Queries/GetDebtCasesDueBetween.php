<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesDueBetween
{
    public function execute(string $from, string $to): Builder
    {
        return DebtCase::query()
            ->whereBetween('next_due_date', [$from, $to])
            ->whereIn('status', ['active', 'legal'])
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderBy('next_due_date');
    }
}