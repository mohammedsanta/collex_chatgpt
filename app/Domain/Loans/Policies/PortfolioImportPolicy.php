<?php

declare(strict_types=1);

namespace App\Domain\Loans\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\PortfolioImport;

final class PortfolioImportPolicy
{
    public function view(User $user, PortfolioImport $import): bool
    {
        return $user->hasPermission('portfolio_imports.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('portfolio_imports.create');
    }

    public function update(User $user, PortfolioImport $import): bool
    {
        return $user->hasPermission('portfolio_imports.update');
    }

    public function process(User $user, PortfolioImport $import): bool
    {
        return $user->hasPermission('portfolio_imports.process');
    }
}