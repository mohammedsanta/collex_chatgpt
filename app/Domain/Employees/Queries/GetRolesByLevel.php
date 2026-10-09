<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\Role;
use Illuminate\Database\Eloquent\Builder;

final class GetRolesByLevel
{
    public function execute(int $minimumLevel): Builder
    {
        return Role::query()
            ->where('level', '>=', $minimumLevel)
            ->orderByDesc('level')
            ->orderBy('name');
    }
}