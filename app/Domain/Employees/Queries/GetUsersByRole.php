<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersByRole
{
    public function execute(int $roleId): Builder
    {
        return User::query()
            ->with([
                'role',
                'supervisor',
            ])
            ->where('role_id', $roleId)
            ->orderBy('name');
    }
}