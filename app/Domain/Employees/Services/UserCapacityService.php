<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;

final class UserCapacityService
{
    public function activeCaseCount(User $user): int
    {
        return $user->assignedDebtCases()
            ->where('status', 'active')
            ->count();
    }

    public function canReceiveCase(User $user, int $capacity): bool
    {
        return $this->activeCaseCount($user) < $capacity;
    }
}