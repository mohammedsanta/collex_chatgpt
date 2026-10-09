<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;

final class GetArchivedPortfolios
{
    public function execute(): Builder
    {
        return Portfolio::query()
            ->where('status', 'archived')
            ->with([
                'bank',
                'createdBy',
                'archivedBy',
            ])
            ->orderByDesc('archived_at');
    }
}