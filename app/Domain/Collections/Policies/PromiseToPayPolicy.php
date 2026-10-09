<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Employees\Models\User;

final class PromiseToPayPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('promises.view');
    }

    public function view(User $user, PromiseToPay $promise): bool
    {
        return $user->hasPermission('promises.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('promises.create');
    }

    public function update(User $user, PromiseToPay $promise): bool
    {
        return $user->hasPermission('promises.update')
            && in_array($promise->status, ['active', 'review'], true);
    }

    public function review(User $user, PromiseToPay $promise): bool
    {
        return $user->hasPermission('promises.review')
            && in_array($promise->status, ['active', 'review'], true);
    }

    public function delete(User $user, PromiseToPay $promise): bool
    {
        return $user->hasPermission('promises.delete')
            && $promise->status === 'active';
    }
}