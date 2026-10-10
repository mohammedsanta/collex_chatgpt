<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;

final class GetLoanStatistics
{
    public function execute(): array
    {
        $query = DebtCase::query();

        return [
            'total' => (clone $query)->count(),

            'active' => (clone $query)
                ->where('status', 'active')
                ->whereRaw('collected_amount < total_debt')
                ->count(),

            'overdue' => (clone $query)->sum('overdue_amount'),

            'collected' => (clone $query)->sum('collected_amount'),
        ];
    }
}