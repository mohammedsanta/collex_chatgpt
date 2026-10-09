<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Database\Eloquent\Builder;

final class GetPortfolioImportsByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return PortfolioImport::query()
            ->whereBetween('created_at', [$from, $to])
            ->with([
                'portfolio',
                'importedBy',
            ])
            ->orderByDesc('created_at');
    }
}