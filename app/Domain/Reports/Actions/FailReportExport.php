<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class FailReportExport
{
    public function execute(
        ReportExport $reportExport,
        string $error
    ): ReportExport {
        try {
            return DB::transaction(function () use (
                $reportExport,
                $error
            ): ReportExport {
                $reportExport = ReportExport::query()
                    ->lockForUpdate()
                    ->findOrFail($reportExport->getKey());

                if ($reportExport->status !== 'pending') {
                    throw new \App\Exceptions\DomainException(
                        'Only pending report exports can be marked as failed.'
                    );
                }

                $reportExport->update([
                    'status' => 'failed',
                    'error' => $error,
                ]);

                return $reportExport->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to mark report export as failed.', [
                'action' => self::class,
                'report_export_id' => $reportExport->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}