<?php

declare(strict_types=1);

namespace App\Domain\Employees\Policies;

use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;

final class RolePermissionPolicy
{
    public function grant(User $user, Role $role): bool
    {
        return $user->hasPermission('roles.assign_permission')
            && ! $role->is_system;
    }

    public function revoke(User $user, Role $role): bool
    {
        return $user->hasPermission('roles.revoke_permission')
            && ! $role->is_system;
    }
}