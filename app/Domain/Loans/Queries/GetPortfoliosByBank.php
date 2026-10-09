<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;

final class GetPortfoliosByBank
{
    public function execute(int $bankId): Builder
    {
        return Portfolio::query()
            ->where('bank_id', $bankId)
            ->with('bank')
            ->orderByDesc('period_year')
            ->orderByDesc('period_month');
    }
}