<?php

declare(strict_types=1);

namespace App\Domain\Loans\Policies;

use App\Domain\Collections\Models\CaseAssignment;
use App\Domain\Employees\Models\User;

final class DebtCaseAssignmentPolicy
{
    public function view(User $user, CaseAssignment $assignment): bool
    {
        return $user->hasPermission('debt_cases.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('debt_cases.assign');
    }

    public function update(User $user, CaseAssignment $assignment): bool
    {
        return $user->hasPermission('debt_cases.assign');
    }

    public function delete(User $user, CaseAssignment $assignment): bool
    {
        return $user->hasPermission('debt_cases.assign');
    }
}