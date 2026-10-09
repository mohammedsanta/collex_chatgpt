<?php

declare(strict_types=1);

namespace App\Domain\Employees\Policies;

use App\Domain\Employees\Models\User;

final class UserAssignmentPolicy
{
    public function assignBank(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }

    public function removeBank(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }

    public function assignInstallmentCompany(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }

    public function removeInstallmentCompany(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }
}