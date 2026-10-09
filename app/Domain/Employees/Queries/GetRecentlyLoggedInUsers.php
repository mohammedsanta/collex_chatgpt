<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetRecentlyLoggedInUsers
{
    public function execute(int $limit = 50): Builder
    {
        return User::query()
            ->whereNotNull('last_login_at')
            ->with('role')
            ->orderByDesc('last_login_at')
            ->limit($limit);
    }
}