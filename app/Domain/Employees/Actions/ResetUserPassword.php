<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ResetUserPassword
{
    public function execute(User $user, string $password): User
    {
        try {
            return DB::transaction(function () use (
                $user,
                $password
            ): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->is_system_account) {
                    throw new \App\Exceptions\DomainException(
                        'System account passwords cannot be reset through this action.'
                    );
                }

                $user->update([
                    'password' => Hash::make($password),
                ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to reset user password.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}