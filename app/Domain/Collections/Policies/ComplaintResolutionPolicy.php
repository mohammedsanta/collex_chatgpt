<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Collections\Models\Complaint;
use App\Domain\Employees\Models\User;

final class ComplaintResolutionPolicy
{
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
}