<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ActivatePortfolio
{
    public function execute(Portfolio $portfolio): Portfolio
    {
        try {
            return DB::transaction(function () use ($portfolio): Portfolio {
                $portfolio = Portfolio::query()
                    ->lockForUpdate()
                    ->findOrFail($portfolio->getKey());

                if ($portfolio->status !== 'draft') {
                    throw new \App\Exceptions\DomainException(
                        'Only draft portfolios can be activated.'
                    );
                }

                $portfolio->update([
                    'status' => 'active',
                    'activated_at' => now(),
                ]);

                return $portfolio->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to activate portfolio.', [
                'action' => self::class,
                'portfolio_id' => $portfolio->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}