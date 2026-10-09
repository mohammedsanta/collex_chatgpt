<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersWithoutBankAssignments
{
    public function execute(): Builder
    {
        return User::query()
            ->whereDoesntHave('banks')
            ->where('is_system_account', false)
            ->with('role')
            ->orderBy('name');
    }
}