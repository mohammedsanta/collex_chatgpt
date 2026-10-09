<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByLateFee
{
    public function execute(float $minimumAmount): Builder
    {
        return DebtCase::query()
            ->where('late_fee', '>=', $minimumAmount)
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderByDesc('late_fee');
    }
}