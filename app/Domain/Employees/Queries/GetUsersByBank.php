<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersByBank
{
    public function execute(int $bankId): Builder
    {
        return User::query()
            ->whereHas('banks', function (Builder $query) use ($bankId): void {
                $query->whereKey($bankId);
            })
            ->with([
                'role',
                'banks',
            ])
            ->orderBy('name');
    }
}