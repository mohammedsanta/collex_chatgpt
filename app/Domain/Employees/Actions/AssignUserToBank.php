<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignUserToBank
{
    public function execute(
        User $user,
        Bank $bank,
        ?User $assignedBy = null,
    ): void {
        try {
            DB::transaction(function () use ($user, $bank, $assignedBy): void {
                DB::table('bank_user')->insertOrIgnore([
                    'bank_id' => $bank->getKey(),
                    'user_id' => $user->getKey(),
                    'assigned_by' => $assignedBy?->getKey(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign user to bank.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'bank_id' => $bank->getKey(),
                'assigned_by' => $assignedBy?->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}