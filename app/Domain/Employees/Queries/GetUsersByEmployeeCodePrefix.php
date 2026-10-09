<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersByEmployeeCodePrefix
{
    public function execute(string $prefix): Builder
    {
        return User::query()
            ->where('employee_code', 'like', $prefix . '%')
            ->with('role')
            ->orderBy('employee_code');
    }
}