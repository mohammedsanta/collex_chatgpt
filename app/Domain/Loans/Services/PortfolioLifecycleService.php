<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Support\Facades\Log;
use Throwable;

final class PortfolioLifecycleService
{
    public function canActivate(Portfolio $portfolio): bool
    {
        return $portfolio->status === 'draft';
    }

    public function canArchive(Portfolio $portfolio): bool
    {
        return $portfolio->status === 'active';
    }

    public function assertMutable(Portfolio $portfolio): void
    {
        if ($portfolio->status === 'archived') {
            throw new \App\Exceptions\DomainException('Archived portfolios are read-only.');
        }
    }

    public function activate(Portfolio $portfolio): Portfolio
    {
        try {
            $portfolio->update([
                'status' => 'active',
                'activated_at' => now(),
            ]);

            return $portfolio->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to activate portfolio.', [
                'portfolio_id' => $portfolio->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function archive(Portfolio $portfolio, ?int $userId = null): Portfolio
    {
        try {
            $portfolio->update([
                'status' => 'archived',
                'archived_at' => now(),
                'archived_by' => $userId,
            ]);

            return $portfolio->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to archive portfolio.', [
                'portfolio_id' => $portfolio->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}