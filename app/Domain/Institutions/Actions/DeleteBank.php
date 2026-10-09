<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteBank
{
    public function execute(Bank $bank): void
    {
        try {
            DB::transaction(function () use ($bank): void {
                $bank = Bank::query()
                    ->lockForUpdate()
                    ->findOrFail($bank->getKey());

                if ($bank->is_active) {
                    throw new \App\Exceptions\DomainException(
                        'An active bank cannot be deleted. Deactivate it first.'
                    );
                }

                $bank->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete bank.', [
                'action' => self::class,
                'bank_id' => $bank->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}