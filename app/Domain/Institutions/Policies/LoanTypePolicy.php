<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\LoanType;

final class LoanTypePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('loan_types.view');
    }

    public function view(User $user, LoanType $loanType): bool
    {
        return $user->hasPermission('loan_types.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('loan_types.create');
    }

    public function update(User $user, LoanType $loanType): bool
    {
        return $user->hasPermission('loan_types.update');
    }

    public function delete(User $user, LoanType $loanType): bool
    {
        return $user->hasPermission('loan_types.delete')
            && ! $loanType->is_active;
    }

    public function activate(User $user, LoanType $loanType): bool
    {
        return $user->hasPermission('loan_types.activate');
    }

    public function deactivate(User $user, LoanType $loanType): bool
    {
        return $user->hasPermission('loan_types.deactivate');
    }
}