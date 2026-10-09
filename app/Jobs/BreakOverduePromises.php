<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Domain\Activity\Services\ActivityLogger;
use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Throwable;

final class BreakOverduePromises implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public function handle(ActivityLogger $activityLogger): void
    {
        PromiseToPay::query()
            ->whereIn('status', ['active', 'partial', 'review'])
            ->whereDate('promise_date', '<', today())
            ->orderBy('id')
            ->chunkById(100, function ($promises) use ($activityLogger): void {
                foreach ($promises as $promise) {
                    DB::transaction(function () use ($promise, $activityLogger): void {
                        $locked = PromiseToPay::query()->lockForUpdate()->find($promise->getKey());
                        if ($locked === null || ! in_array($locked->status, ['active', 'partial', 'review'], true) || $locked->promise_date?->isToday() || $locked->promise_date?->isFuture()) {
                            return;
                        }
                        $locked->update(['status' => 'broken', 'closed_at' => now()]);
                        $activityLogger->log((int) $locked->user_id, 'promise.broken', 'Promise to pay became overdue.', ['promise_id' => $locked->getKey(), 'promised_amount' => (string) $locked->promised_amount], $locked);
                    });
                }
            });
    }
}
