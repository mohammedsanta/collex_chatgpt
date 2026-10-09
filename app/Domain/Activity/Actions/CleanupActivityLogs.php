<?php

declare(strict_types=1);

namespace App\Domain\Activity\Actions;

use App\Domain\Activity\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CleanupActivityLogs
{
    public function execute(int $retentionDays): int
    {
        if ($retentionDays < 1) {
            throw new \InvalidArgumentException(
                'Retention days must be greater than zero.'
            );
        }

        try {
            return DB::transaction(function () use ($retentionDays): int {
                return ActivityLog::query()
                    ->where(
                        'created_at',
                        '<',
                        now()->subDays($retentionDays)
                    )
                    ->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to clean up activity logs.', [
                'action' => self::class,
                'retention_days' => $retentionDays,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}