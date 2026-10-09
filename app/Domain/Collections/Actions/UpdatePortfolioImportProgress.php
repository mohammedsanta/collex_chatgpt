<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PortfolioImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePortfolioImportProgress
{
    public function execute(
        PortfolioImport $import,
        int $totalRows,
        int $successRows,
        int $failedRows,
        ?array $errors = null,
    ): PortfolioImport {
        try {
            return DB::transaction(function () use (
                $import,
                $totalRows,
                $successRows,
                $failedRows,
                $errors,
            ): PortfolioImport {
                $import = PortfolioImport::query()
                    ->lockForUpdate()
                    ->findOrFail($import->getKey());

                if ($import->status !== 'processing') {
                    throw new \App\Exceptions\DomainException(
                        'Only processing imports can have their progress updated.'
                    );
                }

                $import->update([
                    'total_rows' => $totalRows,
                    'success_rows' => $successRows,
                    'failed_rows' => $failedRows,
                    'errors' => $errors,
                ]);

                return $import->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update portfolio import progress.', [
                'action' => self::class,
                'portfolio_import_id' => $import->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}