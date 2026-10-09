<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\DailyCollectionReport;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;

final class SubmitDailyCollectionReport
{
    public function execute(DailyCollectionReport $report): DailyCollectionReport
    {
        return DB::transaction(function () use ($report): DailyCollectionReport {
            $locked = DailyCollectionReport::query()->lockForUpdate()->findOrFail($report->getKey());
            if (! in_array($locked->status, ['draft', 'rejected'], true)) {
                throw new DomainException('Only draft or rejected reports can be submitted.', 'DAILY_REPORT_NOT_SUBMITTABLE');
            }
            $locked->update(['status' => 'submitted', 'submitted_at' => now(), 'approved_by' => null, 'approved_at' => null]);
            return $locked->refresh();
        });
    }
}
