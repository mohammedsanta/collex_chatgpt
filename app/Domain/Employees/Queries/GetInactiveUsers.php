<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetInactiveUsers
{
    public function execute(): Builder
    {
        return User::query()
            ->where('status', 'inactive')
            ->with('role')
            ->orderBy('name');
    }
}