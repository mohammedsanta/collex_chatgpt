<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;

final class FindUserByEmail
{
    public function execute(string $email): ?User
    {
        return User::query()
            ->with(['role', 'supervisor'])
            ->where('email', $email)
            ->first();
    }
}