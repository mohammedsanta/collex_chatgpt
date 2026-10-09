<?php

declare(strict_types=1);

namespace App\Domain\Loans\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\DebtCase;

final class DebtCasePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('debt_cases.view');
    }

    public function view(User $user, DebtCase $case): bool
    {
        return $user->hasPermission('debt_cases.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('debt_cases.create');
    }

    public function update(User $user, DebtCase $case): bool
    {
        return $user->hasPermission('debt_cases.update');
    }

    public function delete(User $user, DebtCase $case): bool
    {
        return $user->hasPermission('debt_cases.delete');
    }

    public function restore(User $user, DebtCase $case): bool
    {
        return $user->hasPermission('debt_cases.restore');
    }

    public function assign(User $user, DebtCase $case): bool
    {
        return $user->hasPermission('debt_cases.assign');
    }
}