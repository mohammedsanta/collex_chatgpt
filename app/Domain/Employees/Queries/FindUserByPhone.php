<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class FindUserByPhone
{
    public function execute(string $phone): ?User
    {
        return User::query()
            ->with([
                'role',
                'supervisor',
            ])
            ->where('phone', $phone)
            ->first();
    }
}