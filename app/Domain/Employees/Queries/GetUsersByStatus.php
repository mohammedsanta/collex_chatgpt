<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersByStatus
{
    public function execute(string $status): Builder
    {
        return User::query()
            ->where('status', $status)
            ->with('role')
            ->orderBy('name');
    }
}