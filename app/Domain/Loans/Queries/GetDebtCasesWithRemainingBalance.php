<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithRemainingBalance
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereColumn('collected_amount', '<', 'total_debt')
            ->with(['client', 'assignedUser'])
            ->orderByDesc('total_debt');
    }
}