<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestorePortfolio
{
    public function execute(int $portfolioId): Portfolio
    {
        try {
            return DB::transaction(function () use ($portfolioId): Portfolio {
                $portfolio = Portfolio::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($portfolioId);

                if (! $portfolio->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The portfolio is not deleted.'
                    );
                }

                $portfolio->restore();

                return $portfolio->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore portfolio.', [
                'action' => self::class,
                'portfolio_id' => $portfolioId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}