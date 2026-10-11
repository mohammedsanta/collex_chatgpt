<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;

final class SearchPortfolios
{
    public function execute(
        ?string $search = null,
        ?string $status = null
    ): Builder {
        return Portfolio::query()
            ->with(['bank'])
            ->withCount('debtCases')
            ->when(filled($search), function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhereHas('bank', function (Builder $bankQuery) use ($search): void {
                            $bankQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when(
                in_array($status, ['draft', 'active', 'archived'], true),
                fn (Builder $query) => $query->where('status', $status)
            )
            ->orderByDesc('period_year')
            ->orderByDesc('period_month')
            ->orderByDesc('id');
    }
}
