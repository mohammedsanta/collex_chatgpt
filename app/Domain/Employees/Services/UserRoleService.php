<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UserRoleService
{
    public function assign(User $user, int $roleId): User
    {
        try {
            if ($user->is_system_account) {
                throw new \App\Exceptions\DomainException(
                    'System accounts cannot have their role changed.'
                );
            }

            $user->update([
                'role_id' => $roleId,
            ]);

            return $user->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to change user role.', [
                'user_id' => $user->id,
                'role_id' => $roleId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}