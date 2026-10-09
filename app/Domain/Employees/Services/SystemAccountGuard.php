<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;

final class SystemAccountGuard
{
    public function assertMutable(User $user): void
    {
        if ($user->is_system_account) {
            throw new \App\Exceptions\DomainException(
                'System accounts cannot be modified.'
            );
        }
    }

    public function assertDeletable(User $user): void
    {
        $this->assertMutable($user);
    }
}