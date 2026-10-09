<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithActivePromise
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereHas('promisesToPay', function (Builder $query): void {
                $query->where('status', 'active');
            })
            ->with(['client', 'assignedUser', 'promisesToPay'])
            ->latest();
    }
}