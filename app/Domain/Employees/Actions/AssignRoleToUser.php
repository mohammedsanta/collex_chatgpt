<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use App\Domain\Employees\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignRoleToUser
{
    public function execute(User $user, int $roleId): User
    {
        try {
            return DB::transaction(function () use ($user, $roleId): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->is_system_account) {
                    throw new \App\Exceptions\DomainException(
                        'System accounts cannot have their role changed.'
                    );
                }

                $role = Role::query()->findOrFail($roleId);

                $user->update([
                    'role_id' => $role->getKey(),
                ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign role to user.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'role_id' => $roleId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}