<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeactivateBank
{
    public function execute(Bank $bank): Bank
    {
        try {
            return DB::transaction(function () use ($bank): Bank {
                $bank = Bank::query()
                    ->lockForUpdate()
                    ->findOrFail($bank->getKey());

                if (! $bank->is_active) {
                    throw new \App\Exceptions\DomainException(
                        'This bank is already inactive.'
                    );
                }

                $bank->update([
                    'is_active' => false,
                ]);

                return $bank->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to deactivate bank.', [
                'action' => self::class,
                'bank_id' => $bank->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}