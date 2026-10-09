<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePromiseToPay
{
    public function execute(
        PromiseToPay $promise,
        array $data
    ): PromiseToPay {
        try {
            return DB::transaction(function () use (
                $promise,
                $data
            ): PromiseToPay {
                $promise = PromiseToPay::query()
                    ->lockForUpdate()
                    ->findOrFail($promise->getKey());

                if (! in_array($promise->status, ['active', 'review'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Only active or review promises can be updated.'
                    );
                }

                $promise->update([
                    'promised_amount' => $data['promised_amount']
                        ?? $promise->promised_amount,
                    'promise_date' => $data['promise_date']
                        ?? $promise->promise_date,
                    'notes' => $data['notes']
                        ?? $promise->notes,
                ]);

                return $promise->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update promise to pay.', [
                'action' => self::class,
                'promise_id' => $promise->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}