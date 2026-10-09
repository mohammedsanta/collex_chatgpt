<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class GetBanksForUser
{
    public function execute(int $userId): Builder
    {
        return Bank::query()
            ->whereHas('users', function (Builder $query) use ($userId): void {
                $query->whereKey($userId);
            })
            ->orderBy('name');
    }
}