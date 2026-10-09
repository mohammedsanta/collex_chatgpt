<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class SearchBanks
{
    public function execute(?string $search = null): Builder
    {
        return Bank::query()
            ->when(
                filled($search),
                function (Builder $query) use ($search): void {
                    $query->where(function (Builder $query) use ($search): void {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    });
                }
            )
            ->orderBy('name');
    }
}