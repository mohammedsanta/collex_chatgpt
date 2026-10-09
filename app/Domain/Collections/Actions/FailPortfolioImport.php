<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PortfolioImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class FailPortfolioImport
{
    /**
     * @param array<int, mixed>|null $errors
     */
    public function execute(
        PortfolioImport $import,
        ?array $errors = null,
    ): PortfolioImport {
        try {
            return DB::transaction(function () use (
                $import,
                $errors,
            ): PortfolioImport {
                $import = PortfolioImport::query()
                    ->lockForUpdate()
                    ->findOrFail($import->getKey());

                if (!in_array($import->status, ['pending', 'processing'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Only pending or processing imports can be marked as failed.'
                    );
                }

                $import->update([
                    'status' => 'failed',
                    'errors' => $errors,
                    'finished_at' => now(),
                ]);

                return $import->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to mark portfolio import as failed.', [
                'action' => self::class,
                'portfolio_import_id' => $import->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}