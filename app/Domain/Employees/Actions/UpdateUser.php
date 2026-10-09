<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateUser
{
    public function execute(User $user, array $data): User
    {
        try {
            return DB::transaction(function () use ($user, $data): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->is_system_account) {
                    throw new \App\Exceptions\DomainException(
                        'System accounts cannot be modified.'
                    );
                }

                $updates = array_intersect_key(
                    $data,
                    array_flip([
                        'name',
                        'email',
                        'phone',
                        'role_id',
                        'supervisor_id',
                        'status',
                    ])
                );

                if (array_key_exists('password', $data)) {
                    $updates['password'] = Hash::make($data['password']);
                }

                $user->update($updates);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update user.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}