<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Collections\Models\Visit;
use App\Domain\Employees\Models\User;

final class VisitPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('visits.view');
    }

    public function view(User $user, Visit $visit): bool
    {
        return $user->hasPermission('visits.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('visits.create');
    }

    public function update(User $user, Visit $visit): bool
    {
        return $user->hasPermission('visits.update');
    }

    public function complete(User $user, Visit $visit): bool
    {
        return $user->hasPermission('visits.complete')
            && $visit->status === 'scheduled';
    }

    public function miss(User $user, Visit $visit): bool
    {
        return $user->hasPermission('visits.update')
            && $visit->status === 'scheduled';
    }

    public function cancel(User $user, Visit $visit): bool
    {
        return $user->hasPermission('visits.update')
            && $visit->status === 'scheduled';
    }

    public function delete(User $user, Visit $visit): bool
    {
        return $user->hasPermission('visits.delete');
    }
}