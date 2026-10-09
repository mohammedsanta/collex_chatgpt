<?php

declare(strict_types=1);

namespace App\Domain\Reports\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Reports\Models\PerformanceSnapshot;

final class PerformanceSnapshotPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('performance_snapshots.view');
    }

    public function view(User $user, PerformanceSnapshot $snapshot): bool
    {
        return $user->hasPermission('performance_snapshots.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('performance_snapshots.create');
    }

    public function update(User $user, PerformanceSnapshot $snapshot): bool
    {
        return $user->hasPermission('performance_snapshots.update');
    }

    public function delete(User $user, PerformanceSnapshot $snapshot): bool
    {
        return $user->hasPermission('performance_snapshots.delete');
    }
}