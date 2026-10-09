<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreUser
{
    public function execute(int $userId): User
    {
        try {
            return DB::transaction(function () use ($userId): User {
                $user = User::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($userId);

                if (! $user->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'This user is not deleted.'
                    );
                }

                $user->restore();

                return $user->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore user.', [
                'action' => self::class,
                'user_id' => $userId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}