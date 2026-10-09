<?php

declare(strict_types=1);

namespace App\Domain\Employees\Policies;

use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\User;

final class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('permissions.view');
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permissions.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('permissions.create');
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permissions.update');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permissions.delete');
    }
}