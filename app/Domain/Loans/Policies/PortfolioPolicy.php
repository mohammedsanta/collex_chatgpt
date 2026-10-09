<?php

declare(strict_types=1);

namespace App\Domain\Loans\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\Portfolio;

final class PortfolioPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('portfolios.view');
    }

    public function view(User $user, Portfolio $portfolio): bool
    {
        return $user->hasPermission('portfolios.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('portfolios.create');
    }

    public function update(User $user, Portfolio $portfolio): bool
    {
        return $user->hasPermission('portfolios.update')
            && $portfolio->status !== 'archived';
    }

    public function activate(User $user, Portfolio $portfolio): bool
    {
        return $user->hasPermission('portfolios.activate')
            && $portfolio->status === 'draft';
    }

    public function archive(User $user, Portfolio $portfolio): bool
    {
        return $user->hasPermission('portfolios.archive')
            && $portfolio->status === 'active';
    }

    public function restore(User $user, Portfolio $portfolio): bool
    {
        return $user->hasPermission('portfolios.restore');
    }

    public function delete(User $user, Portfolio $portfolio): bool
    {
        return $user->hasPermission('portfolios.delete')
            && $portfolio->status === 'draft';
    }
}