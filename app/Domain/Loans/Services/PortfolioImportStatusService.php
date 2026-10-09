<?php

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\PortfolioImport;

final class PortfolioImportStatusService
{
    public function progress(PortfolioImport $import): float
    {
        if ($import->total_rows <= 0) {
            return 0;
        }

        return round(($import->success_rows + $import->failed_rows) / $import->total_rows * 100, 2);
    }
}