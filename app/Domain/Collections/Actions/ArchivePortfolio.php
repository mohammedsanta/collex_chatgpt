<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ArchivePortfolio
{
    public function execute(
        Portfolio $portfolio,
        int $archivedBy,
    ): Portfolio {
        try {
            return DB::transaction(function () use (
                $portfolio,
                $archivedBy,
            ): Portfolio {
                $portfolio = Portfolio::query()
                    ->lockForUpdate()
                    ->findOrFail($portfolio->getKey());

                if ($portfolio->status !== 'active') {
                    throw new \App\Exceptions\DomainException(
                        'Only active portfolios can be archived.'
                    );
                }

                $portfolio->update([
                    'status' => 'archived',
                    'archived_at' => now(),
                    'archived_by' => $archivedBy,
                ]);

                return $portfolio->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to archive portfolio.', [
                'action' => self::class,
                'portfolio_id' => $portfolio->getKey(),
                'archived_by' => $archivedBy,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}