<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Database\Eloquent\Builder;

final class GetPendingPortfolioImports
{
    public function execute(): Builder
    {
        return PortfolioImport::query()
            ->where('status', 'pending')
            ->with([
                'portfolio',
                'importedBy',
            ])
            ->oldest();
    }
}