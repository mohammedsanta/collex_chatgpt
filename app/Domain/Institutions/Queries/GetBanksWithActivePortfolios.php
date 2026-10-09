<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class GetBanksWithActivePortfolios
{
    public function execute(): Builder
    {
        return Bank::query()
            ->where('is_active', true)
            ->whereHas('portfolios', function (Builder $query): void {
                $query->where('status', 'active');
            })
            ->with([
                'portfolios' => function ($query): void {
                    $query->where('status', 'active');
                },
            ])
            ->orderBy('name');
    }
}