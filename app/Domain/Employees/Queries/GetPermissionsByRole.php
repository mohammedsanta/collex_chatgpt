<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

final class GetPermissionsByRole
{
    public function execute(int $roleId): Builder
    {
        return Permission::query()
            ->whereHas('roles', function (Builder $query) use ($roleId): void {
                $query->whereKey($roleId);
            })
            ->orderBy('group')
            ->orderBy('name');
    }
}