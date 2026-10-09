<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Database\Eloquent\Builder;

final class GetMonthlyArchivesByYear
{
    public function execute(int $year): Builder
    {
        return MonthlyArchive::query()
            ->where('year', $year)
            ->with([
                'bank',
                'portfolio',
                'archivedBy',
            ])
            ->orderBy('month');
    }
}