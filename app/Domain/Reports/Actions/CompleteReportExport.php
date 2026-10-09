<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CompleteReportExport
{
    public function execute(
        ReportExport $reportExport,
        string $filePath,
        int $rowCount,
        ?\DateTimeInterface $expiresAt = null
    ): ReportExport {
        try {
            return DB::transaction(function () use (
                $reportExport,
                $filePath,
                $rowCount,
                $expiresAt
            ): ReportExport {
                $reportExport = ReportExport::query()
                    ->lockForUpdate()
                    ->findOrFail($reportExport->getKey());

                if ($reportExport->status !== 'pending') {
                    throw new \App\Exceptions\DomainException(
                        'Only pending report exports can be completed.'
                    );
                }

                $reportExport->update([
                    'status' => 'completed',
                    'file_path' => $filePath,
                    'row_count' => $rowCount,
                    'generated_at' => now(),
                    'expires_at' => $expiresAt,
                    'error' => null,
                ]);

                return $reportExport->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to complete report export.', [
                'action' => self::class,
                'report_export_id' => $reportExport->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}