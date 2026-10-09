<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateUserLoginMetadata
{
    public function execute(
        User $user,
        ?string $ipAddress
    ): User {
        try {
            return DB::transaction(function () use (
                $user,
                $ipAddress
            ): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                $user->update([
                    'last_login_at' => now(),
                    'last_login_ip' => $ipAddress,
                ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update user login metadata.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}