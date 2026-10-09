<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Domain\Activity\Services\ActivityLogger;
use App\Domain\Collections\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

final class MarkMissedVisits implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public function handle(ActivityLogger $activityLogger): void
    {
        Visit::query()->where('status', 'scheduled')->where('scheduled_at', '<', now())->orderBy('id')->chunkById(100, function ($visits) use ($activityLogger): void {
            foreach ($visits as $visit) {
                DB::transaction(function () use ($visit, $activityLogger): void {
                    $locked = Visit::query()->lockForUpdate()->find($visit->getKey());
                    if ($locked === null || $locked->status !== 'scheduled' || $locked->scheduled_at?->isFuture()) {
                        return;
                    }
                    $locked->update(['status' => 'missed']);
                    $activityLogger->log((int) $locked->user_id, 'visit.missed', 'Scheduled visit was not completed in time.', ['visit_id' => $locked->getKey()], $locked);
                });
            }
        });
    }
}
