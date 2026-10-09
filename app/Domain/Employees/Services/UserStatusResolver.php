<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;

final class UserStatusResolver
{
    public function isActive(User $user): bool
    {
        return $user->status === 'active';
    }

    public function isUsable(User $user): bool
    {
        return in_array(
            $user->status,
            ['active'],
            true
        );
    }
}