<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;

final class SearchPortfolios
{
    public function execute(?string $search = null): Builder
    {
        return Portfolio::query()
            ->when(
                filled($search),
                function (Builder $query) use ($search): void {
                    $query->where(function (Builder $query) use ($search): void {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhereHas(
                                'bank',
                                fn (Builder $bankQuery) => $bankQuery
                                    ->where('name', 'like', "%{$search}%")
                            );
                    });
                }
            )
            ->with('bank')
            ->orderByDesc('period_year')
            ->orderByDesc('period_month');
    }
}