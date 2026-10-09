<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Services;

use App\Domain\Employees\Models\User;

final class BankAssignmentResolver
{
    public function assigned(User $user, int $bankId): bool
    {
        return $user->banks()
            ->whereKey($bankId)
            ->exists();
    }
}