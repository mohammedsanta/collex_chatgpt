<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetUnassignedDebtCases
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereNull('assigned_user_id')
            ->whereIn('status', ['active', 'legal'])
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
            ])
            ->orderByDesc('overdue_amount');
    }
}