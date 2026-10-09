<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\DailyCollectionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteDailyCollectionReport
{
    public function execute(DailyCollectionReport $report): void
    {
        try {
            DB::transaction(function () use ($report): void {
                $report = DailyCollectionReport::query()
                    ->lockForUpdate()
                    ->findOrFail($report->getKey());

                if ($report->status !== 'draft') {
                    throw new \App\Exceptions\DomainException(
                        'Only draft daily collection reports can be deleted.'
                    );
                }

                $report->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete daily collection report.', [
                'action' => self::class,
                'report_id' => $report->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}