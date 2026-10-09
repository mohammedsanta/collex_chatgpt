<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UserLoginMetadataService
{
    public function update(User $user, ?string $ip): User
    {
        try {
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $ip,
            ]);

            return $user->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to update login metadata.', [
                'user_id' => $user->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}