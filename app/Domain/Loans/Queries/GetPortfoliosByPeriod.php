<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;

final class GetPortfoliosByPeriod
{
    public function execute(int $year, int $month): Builder
    {
        return Portfolio::query()
            ->where('period_year', $year)
            ->where('period_month', $month)
            ->with('bank')
            ->orderBy('name');
    }
}