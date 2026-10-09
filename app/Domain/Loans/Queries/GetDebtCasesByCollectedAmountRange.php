<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByCollectedAmountRange
{
    public function execute(float $minimum, float $maximum): Builder
    {
        return DebtCase::query()
            ->whereBetween('collected_amount', [$minimum, $maximum])
            ->with(['client', 'assignedUser'])
            ->orderByDesc('collected_amount');
    }
}