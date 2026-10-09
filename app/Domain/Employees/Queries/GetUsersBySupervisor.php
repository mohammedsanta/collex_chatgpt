<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersBySupervisor
{
    public function execute(int $supervisorId): Builder
    {
        return User::query()
            ->with([
                'role',
                'supervisor',
            ])
            ->where('supervisor_id', $supervisorId)
            ->orderBy('name');
    }
}