<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Governorate;

final class GovernoratePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('governorates.view');
    }

    public function view(User $user, Governorate $governorate): bool
    {
        return $user->hasPermission('governorates.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('governorates.create');
    }

    public function update(User $user, Governorate $governorate): bool
    {
        return $user->hasPermission('governorates.update');
    }

    public function delete(User $user, Governorate $governorate): bool
    {
        return $user->hasPermission('governorates.delete');
    }
}