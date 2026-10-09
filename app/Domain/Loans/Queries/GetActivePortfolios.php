<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;

final class GetActivePortfolios
{
    public function execute(): Builder
    {
        return Portfolio::query()
            ->where('status', 'active')
            ->with('bank')
            ->orderByDesc('period_year')
            ->orderByDesc('period_month');
    }
}