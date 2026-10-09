<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Support\Facades\Log;
use Throwable;

final class PortfolioImportProgressService
{
    public function percentage(PortfolioImport $import): float
    {
        if ($import->total_rows <= 0) {
            return 0.0;
        }

        return round(
            (($import->success_rows + $import->failed_rows) / $import->total_rows) * 100,
            2
        );
    }

    public function update(
        PortfolioImport $import,
        int $totalRows,
        int $successRows,
        int $failedRows
    ): PortfolioImport {
        try {
            $import->update([
                'total_rows' => $totalRows,
                'success_rows' => $successRows,
                'failed_rows' => $failedRows,
            ]);

            return $import->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to update portfolio import progress.', [
                'portfolio_import_id' => $import->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}