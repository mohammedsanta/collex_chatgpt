<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithoutRecentPayment
{
    public function execute(string $cutoffDate): Builder
    {
        return DebtCase::query()
            ->where(function (Builder $query) use ($cutoffDate): void {
                $query
                    ->whereNull('last_payment_date')
                    ->orWhere('last_payment_date', '<', $cutoffDate);
            })
            ->whereIn('status', ['active', 'legal'])
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderBy('last_payment_date');
    }
}