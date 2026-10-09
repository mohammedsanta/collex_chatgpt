<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UserSupervisorService
{
    public function assign(User $user, ?int $supervisorId): User
    {
        try {
            if ($supervisorId === $user->id) {
                throw new \App\Exceptions\DomainException(
                    'A user cannot be their own supervisor.'
                );
            }

            $user->update([
                'supervisor_id' => $supervisorId,
            ]);

            return $user->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to assign supervisor.', [
                'user_id' => $user->id,
                'supervisor_id' => $supervisorId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}