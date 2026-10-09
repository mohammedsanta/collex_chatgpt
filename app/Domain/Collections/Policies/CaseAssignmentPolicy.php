<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Collections\Models\CaseAssignment;
use App\Domain\Employees\Models\User;

final class CaseAssignmentPolicy
{
    public function view(User $user, CaseAssignment $assignment): bool
    {
        return $user->status === 'active';
    }

    public function create(User $user): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }

    public function update(User $user, CaseAssignment $assignment): bool
    {
        return $user->status === 'active';
    }

    public function delete(User $user, CaseAssignment $assignment): bool
    {
        return $user->status === 'active'
            && ! $user->is_system_account;
    }
}