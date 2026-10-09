<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersWithDirectPermissions
{
    public function execute(): Builder
    {
        return User::query()
            ->whereHas('permissions')
            ->with([
                'role',
                'permissions',
            ])
            ->orderBy('name');
    }
}