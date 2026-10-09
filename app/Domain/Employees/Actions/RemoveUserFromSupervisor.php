<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RemoveUserFromSupervisor
{
    public function execute(User $user): User
    {
        try {
            return DB::transaction(function () use ($user): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->supervisor_id === null) {
                    throw new \App\Exceptions\DomainException(
                        'The user is not assigned to a supervisor.'
                    );
                }

                $user->update([
                    'supervisor_id' => null,
                ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to remove user from supervisor.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}