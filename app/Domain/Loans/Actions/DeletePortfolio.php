<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeletePortfolio
{
    public function execute(Portfolio $portfolio): void
    {
        try {
            DB::transaction(function () use ($portfolio): void {
                $portfolio = Portfolio::query()
                    ->lockForUpdate()
                    ->findOrFail($portfolio->getKey());

                if ($portfolio->status !== 'draft') {
                    throw new \App\Exceptions\DomainException(
                        'Only a draft portfolio can be deleted.'
                    );
                }

                $portfolio->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete portfolio.', [
                'action' => self::class,
                'portfolio_id' => $portfolio->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}