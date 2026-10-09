<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Employees\Models\User;

final class CollectorAssignmentPolicy
{
    public function assign(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }

    public function unassign(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }
}