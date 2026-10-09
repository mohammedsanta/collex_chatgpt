<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Services;

use App\Domain\Employees\Models\User;

final class InstallmentCompanyAssignmentResolver
{
    public function assigned(User $user, int $companyId): bool
    {
        return $user->installmentCompanies()
            ->whereKey($companyId)
            ->exists();
    }
}