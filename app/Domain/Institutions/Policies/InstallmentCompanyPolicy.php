<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\InstallmentCompany;

final class InstallmentCompanyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('installment_companies.view');
    }

    public function view(User $user, InstallmentCompany $company): bool
    {
        return $user->hasPermission('installment_companies.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('installment_companies.create');
    }

    public function update(User $user, InstallmentCompany $company): bool
    {
        return $user->hasPermission('installment_companies.update');
    }

    public function delete(User $user, InstallmentCompany $company): bool
    {
        return $user->hasPermission('installment_companies.delete')
            && ! $company->is_active;
    }

    public function activate(User $user, InstallmentCompany $company): bool
    {
        return $user->hasPermission('installment_companies.activate');
    }

    public function deactivate(User $user, InstallmentCompany $company): bool
    {
        return $user->hasPermission('installment_companies.deactivate');
    }

    public function restore(User $user, InstallmentCompany $company): bool
    {
        return $user->hasPermission('installment_companies.restore');
    }
}