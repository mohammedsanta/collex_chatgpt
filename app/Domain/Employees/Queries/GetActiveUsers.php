<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveUsers
{
    public function execute(): Builder
    {
        return User::query()
            ->with([
                'role',
                'supervisor',
            ])
            ->where('status', 'active')
            ->orderBy('name');
    }
}