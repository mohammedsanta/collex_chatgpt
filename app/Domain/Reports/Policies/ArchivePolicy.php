<?php

declare(strict_types=1);

namespace App\Domain\Reports\Policies;

use App\Domain\Employees\Models\User;

final class ArchivePolicy
{
    public function archive(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }

    public function restore(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }
}