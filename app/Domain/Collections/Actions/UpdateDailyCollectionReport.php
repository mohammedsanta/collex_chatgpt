<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\DailyCollectionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateDailyCollectionReport
{
    public function execute(
        DailyCollectionReport $report,
        array $data
    ): DailyCollectionReport {
        try {
            return DB::transaction(function () use (
                $report,
                $data
            ): DailyCollectionReport {
                $report = DailyCollectionReport::query()
                    ->lockForUpdate()
                    ->findOrFail($report->getKey());

                if (! in_array($report->status, ['draft', 'rejected'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Only draft or rejected daily collection reports can be updated.'
                    );
                }

                $report->update([
                    'cases_worked' => $data['cases_worked'] ?? $report->cases_worked,
                    'calls_count' => $data['calls_count'] ?? $report->calls_count,
                    'visits_count' => $data['visits_count'] ?? $report->visits_count,
                    'promises_count' => $data['promises_count'] ?? $report->promises_count,
                    'promised_amount' => $data['promised_amount'] ?? $report->promised_amount,
                    'collected_amount' => $data['collected_amount'] ?? $report->collected_amount,
                    'notes' => $data['notes'] ?? $report->notes,
                ]);

                return $report->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update daily collection report.', [
                'action' => self::class,
                'report_id' => $report->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}