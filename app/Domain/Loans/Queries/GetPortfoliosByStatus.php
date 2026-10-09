<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;

final class GetPortfoliosByStatus
{
    public function execute(string $status): Builder
    {
        return Portfolio::query()
            ->where('status', $status)
            ->with('bank')
            ->orderByDesc('period_year')
            ->orderByDesc('period_month');
    }
}