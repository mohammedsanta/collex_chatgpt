<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByInstallmentRange
{
    public function execute(float $minimum, float $maximum): Builder
    {
        return DebtCase::query()
            ->whereBetween('installment_value', [$minimum, $maximum])
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderBy('installment_value');
    }
}