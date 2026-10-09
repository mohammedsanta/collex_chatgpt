<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\Portfolio;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ArchivePortfolio
{
    public function execute(Portfolio $portfolio, int $archivedBy): Portfolio
    {
        try {
            return DB::transaction(function () use ($portfolio, $archivedBy): Portfolio {
                $locked = Portfolio::query()->lockForUpdate()->findOrFail($portfolio->getKey());
                if ($locked->status !== 'active') {
                    throw new DomainException('Only active portfolios can be archived.', 'PORTFOLIO_NOT_ACTIVE');
                }
                $locked->update(['status' => 'archived', 'archived_at' => now(), 'archived_by' => $archivedBy]);
                return $locked->refresh();
            });
        } catch (Throwable $exception) {
            Log::error('Failed to archive portfolio.', ['portfolio_id' => $portfolio->getKey(), 'archived_by' => $archivedBy, 'exception' => $exception]);
            throw $exception;
        }
    }
}
