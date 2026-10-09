<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreatePerformanceSnapshot
{
    public function execute(array $data): PerformanceSnapshot
    {
        try {
            return DB::transaction(function () use ($data): PerformanceSnapshot {
                return PerformanceSnapshot::create([
                    'user_id' => $data['user_id'],
                    'bank_id' => $data['bank_id'],
                    'year' => $data['year'],
                    'month' => $data['month'],
                    'cases_assigned' => $data['cases_assigned'] ?? 0,
                    'cases_processed' => $data['cases_processed'] ?? 0,
                    'promises_total' => $data['promises_total'] ?? 0,
                    'promises_kept' => $data['promises_kept'] ?? 0,
                    'promises_broken' => $data['promises_broken'] ?? 0,
                    'collected_amount' => $data['collected_amount'] ?? 0,
                    'target_amount' => $data['target_amount'] ?? 0,
                    'efficiency' => $data['efficiency'] ?? 0,
                    'rank_position' => $data['rank_position'] ?? null,
                    'calculated_at' => $data['calculated_at'] ?? now(),
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create performance snapshot.', [
                'action' => self::class,
                'user_id' => $data['user_id'] ?? null,
                'bank_id' => $data['bank_id'] ?? null,
                'year' => $data['year'] ?? null,
                'month' => $data['month'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}