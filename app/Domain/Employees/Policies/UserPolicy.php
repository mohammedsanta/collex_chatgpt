<?php

declare(strict_types=1);

namespace App\Domain\Employees\Policies;

use App\Domain\Employees\Models\User;

final class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('users.view');
    }

    public function view(User $user, User $target): bool
    {
        return $user->hasPermission('users.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('users.create');
    }

    public function update(User $user, User $target): bool
    {
        return $user->hasPermission('users.update')
            && ! $target->is_system_account;
    }

    public function delete(User $user, User $target): bool
    {
        return $user->hasPermission('users.delete')
            && ! $target->is_system_account;
    }

    public function restore(User $user, User $target): bool
    {
        return $user->hasPermission('users.restore')
            && ! $target->is_system_account;
    }

    public function changePassword(User $user, User $target): bool
    {
        return $user->hasPermission('users.change_password')
            && ! $target->is_system_account;
    }

    public function assignRole(User $user, User $target): bool
    {
        return $user->hasPermission('users.assign_role')
            && ! $target->is_system_account;
    }

    public function assignSupervisor(User $user, User $target): bool
    {
        return $user->hasPermission('users.assign_supervisor')
            && ! $target->is_system_account;
    }
}