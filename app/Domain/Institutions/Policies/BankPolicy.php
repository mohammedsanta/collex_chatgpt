<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;

final class BankPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('banks.view');
    }

    public function view(User $user, Bank $bank): bool
    {
        return $user->hasPermission('banks.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('banks.create');
    }

    public function update(User $user, Bank $bank): bool
    {
        return $user->hasPermission('banks.update');
    }

    public function delete(User $user, Bank $bank): bool
    {
        return $user->hasPermission('banks.delete')
            && ! $bank->is_active;
    }

    public function activate(User $user, Bank $bank): bool
    {
        return $user->hasPermission('banks.activate');
    }

    public function deactivate(User $user, Bank $bank): bool
    {
        return $user->hasPermission('banks.deactivate');
    }

    public function restore(User $user, Bank $bank): bool
    {
        return $user->hasPermission('banks.restore');
    }
}