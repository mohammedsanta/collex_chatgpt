<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Database\Eloquent\Builder;

final class GetMonthlyArchivesWithSnapshots
{
    public function execute(): Builder
    {
        return MonthlyArchive::query()
            ->whereNotNull('snapshot_path')
            ->with([
                'bank',
                'portfolio',
                'archivedBy',
            ])
            ->orderByDesc('year')
            ->orderByDesc('month');
    }
}