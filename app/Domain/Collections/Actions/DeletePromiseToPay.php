<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeletePromiseToPay
{
    public function execute(PromiseToPay $promise): void
    {
        try {
            DB::transaction(function () use ($promise): void {
                $promise = PromiseToPay::query()
                    ->lockForUpdate()
                    ->findOrFail($promise->getKey());

                if (! in_array($promise->status, ['active', 'review'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Only active or review promises can be deleted.'
                    );
                }

                if ((float) $promise->paid_amount > 0) {
                    throw new \App\Exceptions\DomainException(
                        'A promise with recorded payments cannot be deleted.'
                    );
                }

                $promise->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete promise to pay.', [
                'action' => self::class,
                'promise_id' => $promise->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}