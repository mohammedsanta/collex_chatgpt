<?php

declare(strict_types=1);

namespace App\Domain\Reports\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Reports\Models\ReportExport;

final class ReportExportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('report_exports.view');
    }

    public function view(User $user, ReportExport $export): bool
    {
        return $user->hasPermission('report_exports.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('report_exports.create');
    }

    public function update(User $user, ReportExport $export): bool
    {
        return $user->hasPermission('report_exports.update');
    }

    public function delete(User $user, ReportExport $export): bool
    {
        return $user->hasPermission('report_exports.delete');
    }
}