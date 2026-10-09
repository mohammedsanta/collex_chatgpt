<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByCollectorAndStatus
{
    public function execute(int $collectorId, string $status): Builder
    {
        return DebtCase::query()
            ->where('assigned_user_id', $collectorId)
            ->where('status', $status)
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->latest('created_at');
    }
}