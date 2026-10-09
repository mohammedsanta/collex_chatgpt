<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\Role;
use Illuminate\Database\Eloquent\Builder;

final class GetSystemRoles
{
    public function execute(): Builder
    {
        return Role::query()
            ->where('is_system', true)
            ->with('permissions')
            ->orderByDesc('level');
    }
}