<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateBank
{
    public function execute(Bank $bank, array $data): Bank
    {
        try {
            return DB::transaction(function () use ($bank, $data): Bank {
                $bank = Bank::query()
                    ->lockForUpdate()
                    ->findOrFail($bank->getKey());

                $updates = array_intersect_key(
                    $data,
                    array_flip([
                        'name',
                        'code',
                        'logo_path',
                        'sector',
                        'is_active',
                        'notes',
                    ])
                );

                $bank->update($updates);

                return $bank->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update bank.', [
                'action' => self::class,
                'bank_id' => $bank->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}