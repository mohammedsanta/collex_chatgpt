<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeactivateUser
{
    public function execute(User $user): User
    {
        try {
            return DB::transaction(function () use ($user): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->is_system_account) {
                    throw new \App\Exceptions\DomainException(
                        'System accounts cannot be deactivated.'
                    );
                }

                $user->update([
                    'status' => 'inactive',
                ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to deactivate user.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}