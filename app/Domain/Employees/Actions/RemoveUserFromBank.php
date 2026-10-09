<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RemoveUserFromBank
{
    public function execute(User $user, Bank $bank): void
    {
        try {
            DB::transaction(function () use ($user, $bank): void {
                DB::table('bank_user')
                    ->where('user_id', $user->getKey())
                    ->where('bank_id', $bank->getKey())
                    ->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to remove user from bank.', [
                'action' => self::class,
                'user_id' => $user->getKey(),
                'bank_id' => $bank->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}