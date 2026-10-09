<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\Role;
use Illuminate\Database\Eloquent\Builder;

final class GetRoles
{
    public function execute(): Builder
    {
        return Role::query()
            ->orderBy('level')
            ->orderBy('name');
    }
}