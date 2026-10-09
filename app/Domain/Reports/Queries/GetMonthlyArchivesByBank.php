<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Database\Eloquent\Builder;

final class GetMonthlyArchivesByBank
{
    public function execute(int $bankId): Builder
    {
        return MonthlyArchive::query()
            ->where('bank_id', $bankId)
            ->with([
                'bank',
                'portfolio',
                'archivedBy',
            ])
            ->orderByDesc('year')
            ->orderByDesc('month');
    }
}