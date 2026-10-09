<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersWithoutInstallmentCompanyAssignments
{
    public function execute(): Builder
    {
        return User::query()
            ->whereDoesntHave('installmentCompanies')
            ->where('is_system_account', false)
            ->with('role')
            ->orderBy('name');
    }
}