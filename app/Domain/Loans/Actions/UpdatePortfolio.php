<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePortfolio
{
    public function execute(Portfolio $portfolio, array $data): Portfolio
    {
        try {
            return DB::transaction(function () use ($portfolio, $data): Portfolio {
                $portfolio = Portfolio::query()
                    ->lockForUpdate()
                    ->findOrFail($portfolio->getKey());

                if ($portfolio->status === 'archived') {
                    throw new \App\Exceptions\DomainException(
                        'An archived portfolio cannot be updated.'
                    );
                }

                $portfolio->update($data);

                return $portfolio->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update portfolio.', [
                'action' => self::class,
                'portfolio_id' => $portfolio->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}