<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignUserToSupervisor
{
    public function execute(User $user, ?User $supervisor): User
    {
        try {
            return DB::transaction(function () use ($user, $supervisor): User {
                $user = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($user->is_system_account) {
                    throw new \App\Exceptions\DomainException(
                        'System accounts cannot have a supervisor assigned.'
                    );
                }

                if ($supervisor !== null) {
                    $supervisor = User::query()
                        ->findOrFail($supervisor->getKey());

                    if ($supervisor->getKey() === $user->getKey()) {
                        throw new \App\Exceptions\DomainException(
                            'A user cannot be their own supervisor.'
                        );
                    }
                }

                $user->update([
                    'supervisor_id' => $supervisor?->getKey(),
                ]);

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign user to supervisor.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'supervisor_id' => $supervisor?->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}