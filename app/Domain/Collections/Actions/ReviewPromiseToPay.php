<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ReviewPromiseToPay
{
    public function execute(
        PromiseToPay $promise,
        int $reviewedBy
    ): PromiseToPay {
        try {
            return DB::transaction(function () use (
                $promise,
                $reviewedBy
            ): PromiseToPay {
                $promise = PromiseToPay::query()
                    ->lockForUpdate()
                    ->findOrFail($promise->getKey());

                if (! in_array($promise->status, ['active', 'review'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Only active or review promises can be reviewed.'
                    );
                }

                $paidAmount = (float) $promise->paid_amount;
                $promisedAmount = (float) $promise->promised_amount;

                $status = match (true) {
                    $paidAmount >= $promisedAmount => 'kept',
                    $paidAmount > 0 => 'partial',
                    $promise->promise_date->isPast() => 'broken',
                    default => 'review',
                };

                $promise->update([
                    'status' => $status,
                    'reviewed_by' => $reviewedBy,
                    'reviewed_at' => now(),
                    'closed_at' => $status !== 'review'
                        ? now()
                        : null,
                ]);

                return $promise->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to review promise to pay.', [
                'action' => self::class,
                'promise_id' => $promise->getKey(),
                'reviewed_by' => $reviewedBy,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}