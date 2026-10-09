<?php

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;
use App\Domain\Employees\Models\User;

final class AssignmentCapacityService
{
    public function canAssign(User $user, int $limit): bool
    {
        if ($limit <= 0) {
            return true;
        }

        return DebtCase::query()
            ->where('assigned_user_id', $user->id)
            ->where('status', 'active')
            ->count() < $limit;
    }
}