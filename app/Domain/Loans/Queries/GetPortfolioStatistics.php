<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;

final class GetPortfolioStatistics
{
    /**
     * @return array{
     *     total: int,
     *     draft: int,
     *     active: int,
     *     archived: int,
     *     total_debt: string|int|float
     * }
     */
    public function execute(): array
    {
        $query = Portfolio::query();

        return [
            'total' => (clone $query)->count(),
            'draft' => (clone $query)->where('status', 'draft')->count(),
            'active' => (clone $query)->where('status', 'active')->count(),
            'archived' => (clone $query)->where('status', 'archived')->count(),
            'total_debt' => (clone $query)->sum('total_debt'),
        ];
    }
}
