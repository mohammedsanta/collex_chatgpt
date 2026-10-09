<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Database\Eloquent\Builder;

final class GetMonthlyArchivesByPeriod
{
    public function execute(int $year, int $month): Builder
    {
        return MonthlyArchive::query()
            ->where('year', $year)
            ->where('month', $month)
            ->with([
                'bank',
                'portfolio',
                'archivedBy',
            ])
            ->orderBy('bank_id');
    }
}