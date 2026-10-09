<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetSystemAccounts
{
    public function execute(): Builder
    {
        return User::query()
            ->where('is_system_account', true)
            ->with('role')
            ->orderBy('name');
    }
}