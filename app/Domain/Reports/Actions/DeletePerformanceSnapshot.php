<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeletePerformanceSnapshot
{
    public function execute(PerformanceSnapshot $snapshot): void
    {
        try {
            DB::transaction(function () use ($snapshot): void {
                $snapshot = PerformanceSnapshot::query()
                    ->lockForUpdate()
                    ->findOrFail($snapshot->getKey());

                $snapshot->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete performance snapshot.', [
                'action' => self::class,
                'snapshot_id' => $snapshot->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}