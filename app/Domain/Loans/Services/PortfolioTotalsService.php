<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Support\Facades\Log;
use Throwable;

final class PortfolioTotalsService
{
    public function recalculate(Portfolio $portfolio): Portfolio
    {
        try {
            $query = $portfolio->debtCases();

            $portfolio->update([
                'cases_count' => $query->count(),
                'total_debt' => $query->sum('total_debt'),
            ]);

            return $portfolio->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to recalculate portfolio totals.', [
                'portfolio_id' => $portfolio->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}