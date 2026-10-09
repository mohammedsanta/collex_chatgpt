<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Collections\Models\Complaint;
use App\Domain\Employees\Models\User;

final class ComplaintPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('complaints.view');
    }

    public function view(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('complaints.create');
    }

    public function update(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.update')
            && ! in_array($complaint->status, ['closed', 'rejected'], true);
    }

    public function assign(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.assign')
            && ! in_array($complaint->status, ['closed', 'rejected'], true);
    }

    public function resolve(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.resolve')
            && ! in_array($complaint->status, ['closed', 'rejected'], true);
    }

    public function reject(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.reject')
            && ! in_array($complaint->status, ['closed', 'rejected'], true);
    }

    public function close(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.close');
    }

    public function delete(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.delete')
            && ! in_array($complaint->status, ['closed', 'rejected'], true);
    }

    public function restore(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.restore');
    }
}