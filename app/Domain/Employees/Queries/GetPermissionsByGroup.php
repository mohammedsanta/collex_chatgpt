<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

final class GetPermissionsByGroup
{
    public function execute(?string $group = null): Builder
    {
        return Permission::query()
            ->when(
                filled($group),
                fn (Builder $query) => $query->where('group', $group)
            )
            ->orderBy('group')
            ->orderBy('name');
    }
}