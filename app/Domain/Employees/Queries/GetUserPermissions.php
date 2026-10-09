<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUserPermissions
{
    public function execute(int $userId): Builder
    {
        return User::query()
            ->whereKey($userId)
            ->with([
                'role.permissions',
                'permissions',
            ]);
    }
}