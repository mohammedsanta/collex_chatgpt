<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;

final class UserPermissionService
{
    public function hasPermission(User $user, string $permission): bool
    {
        if ($user->is_system_account) {
            return true;
        }

        return $user->permissions()
            ->where('name', $permission)
            ->exists()
            || $user->role?->permissions()
                ->where('name', $permission)
                ->exists();
    }
}