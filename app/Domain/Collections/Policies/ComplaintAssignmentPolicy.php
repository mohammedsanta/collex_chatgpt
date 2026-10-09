<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Collections\Models\Complaint;
use App\Domain\Employees\Models\User;

final class ComplaintAssignmentPolicy
{
    public function assign(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.assign')
            && ! in_array($complaint->status, ['closed', 'rejected'], true);
    }

    public function unassign(User $user, Complaint $complaint): bool
    {
        return $user->hasPermission('complaints.assign')
            && ! in_array($complaint->status, ['closed', 'rejected'], true);
    }
}