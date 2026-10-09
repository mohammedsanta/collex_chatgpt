<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersWithBothAssignments
{
    public function execute(): Builder
    {
        return User::query()
            ->whereHas('banks')
            ->whereHas('installmentCompanies')
            ->with([
                'role',
                'banks',
                'installmentCompanies',
            ])
            ->orderBy('name');
    }
}