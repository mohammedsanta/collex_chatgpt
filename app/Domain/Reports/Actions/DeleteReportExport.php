<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteReportExport
{
    public function execute(ReportExport $reportExport): void
    {
        try {
            DB::transaction(function () use ($reportExport): void {
                $reportExport = ReportExport::query()
                    ->lockForUpdate()
                    ->findOrFail($reportExport->getKey());

                if ($reportExport->status === 'pending') {
                    throw new \App\Exceptions\DomainException(
                        'Pending report exports cannot be deleted.'
                    );
                }

                $reportExport->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete report export.', [
                'action' => self::class,
                'report_export_id' => $reportExport->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}