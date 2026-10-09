<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveCollectors
{
    public function execute(): Builder
    {
        return User::query()
            ->where('status', 'active')
            ->with('role')
            ->whereHas('role', function (Builder $query): void {
                $query->where('name', 'like', '%collector%');
            })
            ->orderBy('name');
    }
}