<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Database\Eloquent\Builder;

final class GetPendingDailyCollectionReports
{
    public function execute(): Builder
    {
        return DailyCollectionReport::query()
            ->whereIn('status', ['draft', 'submitted'])
            ->with([
                'bank',
                'user',
                'approvedBy',
            ])
            ->orderByDesc('report_date')
            ->orderBy('user_id');
    }
}