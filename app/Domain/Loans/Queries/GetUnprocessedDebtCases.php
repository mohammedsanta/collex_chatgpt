<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetUnprocessedDebtCases
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->where('is_processed', false)
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