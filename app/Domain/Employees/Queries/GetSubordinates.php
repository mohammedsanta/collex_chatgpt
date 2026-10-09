<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetSubordinates
{
    public function execute(int $supervisorId): Builder
    {
        return User::query()
            ->where('supervisor_id', $supervisorId)
            ->with('role')
            ->orderBy('name');
    }
}