<?php

declare(strict_types=1);

namespace App\Domain\Customers\Policies;

use App\Domain\Customers\Models\ClientPhone;
use App\Domain\Employees\Models\User;

final class ClientPhonePolicy
{
    public function view(User $user, ClientPhone $phone): bool
    {
        return $user->hasPermission('clients.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('clients.update');
    }

    public function update(User $user, ClientPhone $phone): bool
    {
        return $user->hasPermission('clients.update');
    }

    public function delete(User $user, ClientPhone $phone): bool
    {
        return $user->hasPermission('clients.update');
    }
}