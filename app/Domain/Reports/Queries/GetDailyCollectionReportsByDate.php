<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Database\Eloquent\Builder;

final class GetDailyCollectionReportsByDate
{
    public function execute(string $date): Builder
    {
        return DailyCollectionReport::query()
            ->whereDate('report_date', $date)
            ->with([
                'bank',
                'user',
                'approvedBy',
            ])
            ->orderBy('user_id');
    }
}