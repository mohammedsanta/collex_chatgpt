<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class BankAssignmentService
{
    public function assign(User $user, int $bankId, ?int $assignedBy): void
    {
        try {
            DB::transaction(function () use ($user, $bankId, $assignedBy) {
                $user->banks()->syncWithoutDetaching([
                    $bankId => ['assigned_by' => $assignedBy],
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign bank.', [
                'user_id' => $user->id,
                'bank_id' => $bankId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function remove(User $user, int $bankId): void
    {
        try {
            DB::transaction(function () use ($user, $bankId) {
                $user->banks()->detach($bankId);
            });
        } catch (Throwable $e) {
            Log::error('Failed to remove bank assignment.', [
                'user_id' => $user->id,
                'bank_id' => $bankId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}