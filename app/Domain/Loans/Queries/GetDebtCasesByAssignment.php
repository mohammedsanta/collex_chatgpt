<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByAssignment
{
    public function execute(?int $userId = null): Builder
    {
        return DebtCase::query()
            ->when(
                $userId !== null,
                fn (Builder $query) => $query->where('assigned_user_id', $userId)
            )
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderByDesc('overdue_amount');
    }
}