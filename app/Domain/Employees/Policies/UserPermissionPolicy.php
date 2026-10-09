<?php

declare(strict_types=1);

namespace App\Domain\Employees\Policies;

use App\Domain\Employees\Models\User;

final class UserPermissionPolicy
{
    public function grant(User $user, User $target): bool
    {
        return $user->hasPermission('users.grant_permission')
            && ! $target->is_system_account;
    }

    public function revoke(User $user, User $target): bool
    {
        return $user->hasPermission('users.revoke_permission')
            && ! $target->is_system_account;
    }
}