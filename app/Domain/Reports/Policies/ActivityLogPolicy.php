<?php

declare(strict_types=1);

namespace App\Domain\Reports\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Reports\Models\ActivityLog;

final class ActivityLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('activity_logs.view');
    }

    public function view(User $user, ActivityLog $log): bool
    {
        return $user->hasPermission('activity_logs.view');
    }
}