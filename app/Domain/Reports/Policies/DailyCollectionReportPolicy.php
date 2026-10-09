<?php

declare(strict_types=1);

namespace App\Domain\Reports\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Reports\Models\DailyCollectionReport;

final class DailyCollectionReportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('daily_reports.view');
    }

    public function view(User $user, DailyCollectionReport $report): bool
    {
        return $user->hasPermission('daily_reports.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('daily_reports.create');
    }

    public function update(User $user, DailyCollectionReport $report): bool
    {
        return $user->hasPermission('daily_reports.update')
            && $report->status === 'draft';
    }

    public function submit(User $user, DailyCollectionReport $report): bool
    {
        return $user->hasPermission('daily_reports.submit')
            && $report->status === 'draft';
    }

    public function approve(User $user, DailyCollectionReport $report): bool
    {
        return $user->hasPermission('daily_reports.approve')
            && $report->status === 'submitted';
    }

    public function reject(User $user, DailyCollectionReport $report): bool
    {
        return $user->hasPermission('daily_reports.reject')
            && $report->status === 'submitted';
    }

    public function delete(User $user, DailyCollectionReport $report): bool
    {
        return $user->hasPermission('daily_reports.delete')
            && $report->status === 'draft';
    }
}