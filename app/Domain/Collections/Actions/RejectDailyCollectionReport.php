<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\DailyCollectionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RejectDailyCollectionReport
{
    public function execute(
        DailyCollectionReport $report,
        ?string $notes = null
    ): DailyCollectionReport {
        try {
            return DB::transaction(function () use (
                $report,
                $notes
            ): DailyCollectionReport {
                $report = DailyCollectionReport::query()
                    ->lockForUpdate()
                    ->findOrFail($report->getKey());

                if ($report->status !== 'submitted') {
                    throw new \App\Exceptions\DomainException(
                        'Only submitted daily collection reports can be rejected.'
                    );
                }

                $report->update([
                    'status' => 'rejected',
                    'notes' => $notes ?? $report->notes,
                ]);

                return $report->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to reject daily collection report.', [
                'action' => self::class,
                'report_id' => $report->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}