<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesDueToday
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereDate('next_due_date', today())
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