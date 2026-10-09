<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByLastPaymentDate
{
    public function execute(string $from, string $to): Builder
    {
        return DebtCase::query()
            ->whereBetween('last_payment_date', [$from, $to])
            ->with([
                'client',
                'portfolio',
                'bank',
                'assignedUser',
            ])
            ->orderByDesc('last_payment_date');
    }
}