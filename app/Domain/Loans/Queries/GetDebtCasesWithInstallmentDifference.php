<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithInstallmentDifference
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereNotNull('min_installment_diff')
            ->where('min_installment_diff', '>', 0)
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->orderByDesc('min_installment_diff');
    }
}