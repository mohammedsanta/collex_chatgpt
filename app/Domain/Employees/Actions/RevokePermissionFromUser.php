<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RevokePermissionFromUser
{
    public function execute(User $user, Permission $permission): User
    {
        try {
            return DB::transaction(function () use ($user, $permission): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->is_system_account) {
                    throw new \App\Exceptions\DomainException(
                        'System accounts cannot have direct permissions changed.'
                    );
                }

                DB::table('permission_user')
                    ->where('user_id', $user->getKey())
                    ->where('permission_id', $permission->getKey())
                    ->update([
                        'granted' => false,
                        'updated_at' => now(),
                    ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to revoke permission from user.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'permission_id' => $permission->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}