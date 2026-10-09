<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\DailyCollectionReport;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;

final class ApproveDailyCollectionReport
{
    public function execute(DailyCollectionReport $report, int $approvedBy): DailyCollectionReport
    {
        return DB::transaction(function () use ($report, $approvedBy): DailyCollectionReport {
            $locked = DailyCollectionReport::query()->lockForUpdate()->findOrFail($report->getKey());
            if ($locked->status !== 'submitted') {
                throw new DomainException('Only submitted reports can be approved.', 'DAILY_REPORT_NOT_SUBMITTED');
            }
            $locked->update(['status' => 'approved', 'approved_by' => $approvedBy, 'approved_at' => now()]);
            return $locked->refresh();
        });
    }
}
