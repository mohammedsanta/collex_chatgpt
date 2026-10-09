<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersWithoutSupervisor
{
    public function execute(): Builder
    {
        return User::query()
            ->whereNull('supervisor_id')
            ->with('role')
            ->orderBy('name');
    }
}