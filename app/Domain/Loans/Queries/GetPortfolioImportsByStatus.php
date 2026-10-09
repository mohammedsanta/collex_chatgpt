<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Database\Eloquent\Builder;

final class GetPortfolioImportsByStatus
{
    public function execute(string $status): Builder
    {
        return PortfolioImport::query()
            ->where('status', $status)
            ->with([
                'portfolio',
                'importedBy',
            ])
            ->orderByDesc('created_at');
    }
}