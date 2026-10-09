<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Database\Eloquent\Builder;

final class GetDailyCollectionReportsByUser
{
    public function execute(int $userId): Builder
    {
        return DailyCollectionReport::query()
            ->where('user_id', $userId)
            ->with([
                'bank',
                'user',
                'approvedBy',
            ])
            ->orderByDesc('report_date');
    }
}