<?php

declare(strict_types=1);

namespace App\Domain\Reports\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Reports\Models\MonthlyArchive;

final class MonthlyArchivePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('monthly_archives.view');
    }

    public function view(User $user, MonthlyArchive $archive): bool
    {
        return $user->hasPermission('monthly_archives.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('monthly_archives.create');
    }

    public function update(User $user, MonthlyArchive $archive): bool
    {
        return $user->hasPermission('monthly_archives.update');
    }

    public function delete(User $user, MonthlyArchive $archive): bool
    {
        return $user->hasPermission('monthly_archives.delete');
    }
}