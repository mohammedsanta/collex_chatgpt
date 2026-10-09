<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\DailyCollectionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class SubmitDailyCollectionReport
{
    public function execute(DailyCollectionReport $report): DailyCollectionReport
    {
        try {
            return DB::transaction(function () use ($report): DailyCollectionReport {
                $report = DailyCollectionReport::query()
                    ->lockForUpdate()
                    ->findOrFail($report->getKey());

                if ($report->status !== 'draft') {
                    throw new \App\Exceptions\DomainException(
                        'Only draft daily collection reports can be submitted.'
                    );
                }

                $report->update([
                    'status' => 'submitted',
                    'submitted_at' => now(),
                ]);

                return $report->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to submit daily collection report.', [
                'action' => self::class,
                'report_id' => $report->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}