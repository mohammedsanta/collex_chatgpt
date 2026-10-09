<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Database\Eloquent\Builder;

final class GetDailyCollectionReportsByStatus
{
    public function execute(string $status): Builder
    {
        return DailyCollectionReport::query()
            ->where('status', $status)
            ->with([
                'bank',
                'user',
                'approvedBy',
            ])
            ->orderByDesc('report_date');
    }
}