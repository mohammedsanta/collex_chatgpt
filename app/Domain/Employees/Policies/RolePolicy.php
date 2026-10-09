<?php

declare(strict_types=1);

namespace App\Domain\Employees\Policies;

use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;

final class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('roles.view');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->hasPermission('roles.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('roles.create');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->hasPermission('roles.update')
            && ! $role->is_system;
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermission('roles.delete')
            && ! $role->is_system;
    }

    public function assignPermission(User $user, Role $role): bool
    {
        return $user->hasPermission('roles.assign_permission')
            && ! $role->is_system;
    }
}