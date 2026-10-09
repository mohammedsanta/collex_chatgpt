<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByPortfolioAndStatus
{
    public function execute(int $portfolioId, string $status): Builder
    {
        return DebtCase::query()
            ->where('portfolio_id', $portfolioId)
            ->where('status', $status)
            ->with([
                'client',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->latest('created_at');
    }
}