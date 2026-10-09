<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByDpdRange
{
    public function execute(int $minimum, int $maximum): Builder
    {
        return DebtCase::query()
            ->whereBetween('dpd', [$minimum, $maximum])
            ->with(['client', 'assignedUser'])
            ->orderByDesc('dpd');
    }
}