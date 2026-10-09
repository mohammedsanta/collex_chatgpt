<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\DailyCollectionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ApproveDailyCollectionReport
{
    public function execute(
        DailyCollectionReport $report,
        int $approvedBy
    ): DailyCollectionReport {
        try {
            return DB::transaction(function () use (
                $report,
                $approvedBy
            ): DailyCollectionReport {
                $report = DailyCollectionReport::query()
                    ->lockForUpdate()
                    ->findOrFail($report->getKey());

                if ($report->status !== 'submitted') {
                    throw new \App\Exceptions\DomainException(
                        'Only submitted daily collection reports can be approved.'
                    );
                }

                $report->update([
                    'status' => 'approved',
                    'approved_by' => $approvedBy,
                    'approved_at' => now(),
                ]);

                return $report->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to approve daily collection report.', [
                'action' => self::class,
                'report_id' => $report->getKey(),
                'approved_by' => $approvedBy,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}