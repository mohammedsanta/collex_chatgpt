<?php

declare(strict_types=1);

namespace App\Domain\Employees\Policies;

use App\Domain\Employees\Models\User;

final class UserStatusPolicy
{
    public function activate(User $user, User $target): bool
    {
        return $user->hasPermission('users.activate')
            && ! $target->is_system_account;
    }

    public function deactivate(User $user, User $target): bool
    {
        return $user->hasPermission('users.deactivate')
            && ! $target->is_system_account;
    }

    public function suspend(User $user, User $target): bool
    {
        return $user->hasPermission('users.suspend')
            && ! $target->is_system_account;
    }
}