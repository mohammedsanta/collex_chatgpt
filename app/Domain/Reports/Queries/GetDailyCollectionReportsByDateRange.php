<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Database\Eloquent\Builder;

final class GetDailyCollectionReportsByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return DailyCollectionReport::query()
            ->whereBetween('report_date', [$from, $to])
            ->with([
                'bank',
                'user',
                'approvedBy',
            ])
            ->orderByDesc('report_date');
    }
}