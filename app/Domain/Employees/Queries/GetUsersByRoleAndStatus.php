<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersByRoleAndStatus
{
    public function execute(int $roleId, string $status): Builder
    {
        return User::query()
            ->where('role_id', $roleId)
            ->where('status', $status)
            ->with('role')
            ->orderBy('name');
    }
}