<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;

final class UserPermissionResolver
{
    public function hasDirectPermission(User $user, string $permission): bool
    {
        return $user->permissions()
            ->where('name', $permission)
            ->wherePivot('granted', true)
            ->exists();
    }

    public function hasRolePermission(User $user, string $permission): bool
    {
        return $user->role()
            ->whereHas('permissions', function ($query) use ($permission): void {
                $query->where('name', $permission);
            })
            ->exists();
    }
}