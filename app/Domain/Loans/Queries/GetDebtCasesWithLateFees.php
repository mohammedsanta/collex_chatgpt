<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithLateFees
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->where('late_fee', '>', 0)
            ->with(['client', 'assignedUser'])
            ->orderByDesc('late_fee');
    }
}