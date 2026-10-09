<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;

final class FindUserByEmployeeCode
{
    public function execute(string $employeeCode): ?User
    {
        return User::query()
            ->with(['role', 'supervisor'])
            ->where('employee_code', $employeeCode)
            ->first();
    }
}