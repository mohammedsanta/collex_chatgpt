<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByPortfolioAndCollector
{
    public function execute(int $portfolioId, int $collectorId): Builder
    {
        return DebtCase::query()
            ->where('portfolio_id', $portfolioId)
            ->where('assigned_user_id', $collectorId)
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