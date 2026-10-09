<?php

declare(strict_types=1);

namespace App\Domain\Customers\Policies;

use App\Domain\Customers\Models\Client;
use App\Domain\Employees\Models\User;

final class ClientPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('clients.view');
    }

    public function view(User $user, Client $client): bool
    {
        return $user->hasPermission('clients.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('clients.create');
    }

    public function update(User $user, Client $client): bool
    {
        return $user->hasPermission('clients.update');
    }

    public function delete(User $user, Client $client): bool
    {
        return $user->hasPermission('clients.delete');
    }

    public function restore(User $user, Client $client): bool
    {
        return $user->hasPermission('clients.restore');
    }
}