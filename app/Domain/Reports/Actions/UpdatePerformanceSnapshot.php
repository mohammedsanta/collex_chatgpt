<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePerformanceSnapshot
{
    public function execute(
        PerformanceSnapshot $snapshot,
        array $data
    ): PerformanceSnapshot {
        try {
            return DB::transaction(function () use (
                $snapshot,
                $data
            ): PerformanceSnapshot {
                $snapshot = PerformanceSnapshot::query()
                    ->lockForUpdate()
                    ->findOrFail($snapshot->getKey());

                $snapshot->update([
                    'cases_assigned' => $data['cases_assigned']
                        ?? $snapshot->cases_assigned,
                    'cases_processed' => $data['cases_processed']
                        ?? $snapshot->cases_processed,
                    'promises_total' => $data['promises_total']
                        ?? $snapshot->promises_total,
                    'promises_kept' => $data['promises_kept']
                        ?? $snapshot->promises_kept,
                    'promises_broken' => $data['promises_broken']
                        ?? $snapshot->promises_broken,
                    'collected_amount' => $data['collected_amount']
                        ?? $snapshot->collected_amount,
                    'target_amount' => $data['target_amount']
                        ?? $snapshot->target_amount,
                    'efficiency' => $data['efficiency']
                        ?? $snapshot->efficiency,
                    'rank_position' => $data['rank_position']
                        ?? $snapshot->rank_position,
                    'calculated_at' => $data['calculated_at']
                        ?? $snapshot->calculated_at,
                ]);

                return $snapshot->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update performance snapshot.', [
                'action' => self::class,
                'snapshot_id' => $snapshot->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}