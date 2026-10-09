<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Database\Eloquent\Builder;

final class GetPortfolioImportsByPortfolio
{
    public function execute(int $portfolioId): Builder
    {
        return PortfolioImport::query()
            ->where('portfolio_id', $portfolioId)
            ->with([
                'portfolio',
                'importedBy',
            ])
            ->latest();
    }
}