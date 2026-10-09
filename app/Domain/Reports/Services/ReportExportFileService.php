<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ReportExportFileService
{
    public function markCompleted(
        ReportExport $export,
        string $path,
        int $rowCount
    ): ReportExport {
        try {
            $export->update([
                'status' => 'completed',
                'file_path' => $path,
                'row_count' => $rowCount,
                'generated_at' => now(),
            ]);

            return $export->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to complete report export.', [
                'report_export_id' => $export->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}