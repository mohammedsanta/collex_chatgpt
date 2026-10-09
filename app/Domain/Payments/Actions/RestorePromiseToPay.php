<?php

declare(strict_types=1);

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Models\PromiseToPay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestorePromiseToPay
{
    public function execute(int $promiseId): PromiseToPay
    {
        try {
            return DB::transaction(function () use ($promiseId): PromiseToPay {
                $promise = PromiseToPay::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($promiseId);

                if (! $promise->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The promise to pay is not deleted.'
                    );
                }

                $promise->restore();

                return $promise->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore promise to pay.', [
                'action' => self::class,
                'promise_id' => $promiseId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}