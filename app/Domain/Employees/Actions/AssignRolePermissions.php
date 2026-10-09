<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Role;
use Illuminate\Support\Facades\DB;

final class AssignRolePermissions
{
    public function execute(Role $role, array $permissionIds): void
    {
        DB::transaction(function () use ($role, $permissionIds): void {
            $role->permissions()->sync($permissionIds);
        });
    }
}
