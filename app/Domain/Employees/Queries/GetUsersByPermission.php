<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersByPermission
{
    public function execute(int $permissionId): Builder
    {
        return User::query()
            ->whereHas('permissions', function (Builder $query) use ($permissionId): void {
                $query
                    ->whereKey($permissionId)
                    ->wherePivot('granted', true);
            })
            ->with('role')
            ->orderBy('name');
    }
}