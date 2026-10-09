<?php

declare(strict_types=1);

namespace App\Domain\Collections\Policies;

use App\Domain\Collections\Models\CaseInteraction;
use App\Domain\Employees\Models\User;

final class CaseInteractionPolicy
{
    public function view(User $user, CaseInteraction $interaction): bool
    {
        return $user->hasPermission('interactions.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('interactions.create');
    }

    public function update(User $user, CaseInteraction $interaction): bool
    {
        return $user->hasPermission('interactions.update');
    }

    public function delete(User $user, CaseInteraction $interaction): bool
    {
        return $user->hasPermission('interactions.delete');
    }
}