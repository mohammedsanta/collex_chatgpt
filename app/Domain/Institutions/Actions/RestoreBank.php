<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreBank
{
    public function execute(int $bankId): Bank
    {
        try {
            return DB::transaction(function () use ($bankId): Bank {
                $bank = Bank::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($bankId);

                if (! $bank->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The bank is not deleted.'
                    );
                }

                $bank->restore();

                return $bank->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore bank.', [
                'action' => self::class,
                'bank_id' => $bankId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}