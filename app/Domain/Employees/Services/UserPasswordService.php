<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UserPasswordService
{
    public function change(User $user, string $password): User
    {
        try {
            $user->update([
                'password' => Hash::make($password),
            ]);

            return $user->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to change user password.', [
                'user_id' => $user->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}