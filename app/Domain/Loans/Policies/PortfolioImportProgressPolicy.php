<?php

declare(strict_types=1);

namespace App\Domain\Loans\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\PortfolioImport;

final class PortfolioImportProgressPolicy
{
    public function update(User $user, PortfolioImport $import): bool
    {
        return $user->status === 'active'
            && in_array($import->status, ['processing', 'pending'], true);
    }

    public function complete(User $user, PortfolioImport $import): bool
    {
        return $user->status === 'active'
            && $import->status === 'processing';
    }

    public function fail(User $user, PortfolioImport $import): bool
    {
        return $user->status === 'active'
            && $import->status === 'processing';
    }
}