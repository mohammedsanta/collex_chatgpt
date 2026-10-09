<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UserStatusService
{
    public function activate(User $user): User
    {
        return $this->change($user, 'active');
    }

    public function deactivate(User $user): User
    {
        return $this->change($user, 'inactive');
    }

    public function suspend(User $user): User
    {
        return $this->change($user, 'suspended');
    }

    private function change(User $user, string $status): User
    {
        try {
            if ($user->is_system_account) {
                throw new \App\Exceptions\DomainException(
                    'System accounts cannot have their status changed.'
                );
            }

            $user->update(['status' => $status]);

            return $user->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to change user status.', [
                'user_id' => $user->id,
                'status' => $status,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}