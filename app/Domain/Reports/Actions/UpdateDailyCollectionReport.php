<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\DailyCollectionReport;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;

final class UpdateDailyCollectionReport
{
    /** @param array<string, mixed> $data */
    public function execute(DailyCollectionReport $report, array $data): DailyCollectionReport
    {
        return DB::transaction(function () use ($report, $data): DailyCollectionReport {
            $locked = DailyCollectionReport::query()->lockForUpdate()->findOrFail($report->getKey());
            if ($locked->status !== 'draft') {
                throw new DomainException('Only draft daily reports can be edited.', 'DAILY_REPORT_NOT_DRAFT');
            }
            $allowed = array_intersect_key($data, array_flip(['cases_worked','calls_count','visits_count','promises_count','promised_amount','collected_amount','notes']));
            $locked->update($allowed);
            return $locked->refresh();
        });
    }
}
