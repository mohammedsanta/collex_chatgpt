<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithRecentPayment
{
    public function execute(string $from): Builder
    {
        return DebtCase::query()
            ->where('last_payment_date', '>=', $from)
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->latest('last_payment_date');
    }
}