<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetInactiveDebtCases
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->where('status', 'inactive')
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->latest('updated_at');
    }
}