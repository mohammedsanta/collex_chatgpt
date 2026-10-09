<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

final class GetAllPermissions
{
    public function execute(): Builder
    {
        return Permission::query()
            ->orderBy('group')
            ->orderBy('name');
    }
}