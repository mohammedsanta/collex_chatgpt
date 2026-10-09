<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersBySupervisorAndStatus
{
    public function execute(int $supervisorId, string $status): Builder
    {
        return User::query()
            ->where('supervisor_id', $supervisorId)
            ->where('status', $status)
            ->with([
                'role',
                'supervisor',
            ])
            ->orderBy('name');
    }
}