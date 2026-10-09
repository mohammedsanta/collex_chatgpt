<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use App\Domain\Employees\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ChangeUserRole
{
    public function execute(User $user, Role $role): User
    {
        try {
            return DB::transaction(function () use ($user, $role): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->is_system_account) {
                    throw new \App\Exceptions\DomainException(
                        'The role of a system account cannot be changed.'
                    );
                }

                $role = Role::query()
                    ->findOrFail($role->getKey());

                $user->update([
                    'role_id' => $role->getKey(),
                ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to change user role.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'role_id' => $role->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}