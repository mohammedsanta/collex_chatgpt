<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Database\Eloquent\Builder;

final class GetDailyCollectionReportsByBank
{
    public function execute(int $bankId): Builder
    {
        return DailyCollectionReport::query()
            ->where('bank_id', $bankId)
            ->with([
                'bank',
                'user',
                'approvedBy',
            ])
            ->orderByDesc('report_date');
    }
}