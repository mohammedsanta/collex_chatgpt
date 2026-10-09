<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\DailyCollectionReport;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;

final class RejectDailyCollectionReport
{
    public function execute(DailyCollectionReport $report, ?string $reason = null): DailyCollectionReport
    {
        return DB::transaction(function () use ($report, $reason): DailyCollectionReport {
            $locked = DailyCollectionReport::query()->lockForUpdate()->findOrFail($report->getKey());
            if ($locked->status !== 'submitted') {
                throw new DomainException('Only submitted reports can be rejected.', 'DAILY_REPORT_NOT_SUBMITTED');
            }
            $notes = trim((string) $locked->notes);
            if ($reason !== null && trim($reason) !== '') {
                $notes = trim($notes."\nRejection reason: ".trim($reason));
            }
            $locked->update(['status' => 'rejected', 'approved_by' => null, 'approved_at' => null, 'notes' => $notes === '' ? null : $notes]);
            return $locked->refresh();
        });
    }
}
