<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\DailyCollectionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateDailyCollectionReport
{
    public function execute(array $data): DailyCollectionReport
    {
        try {
            return DB::transaction(function () use ($data): DailyCollectionReport {
                return DailyCollectionReport::create([
                    'bank_id' => $data['bank_id'],
                    'user_id' => $data['user_id'],
                    'report_date' => $data['report_date'],
                    'cases_worked' => $data['cases_worked'] ?? 0,
                    'calls_count' => $data['calls_count'] ?? 0,
                    'visits_count' => $data['visits_count'] ?? 0,
                    'promises_count' => $data['promises_count'] ?? 0,
                    'promised_amount' => $data['promised_amount'] ?? 0,
                    'collected_amount' => $data['collected_amount'] ?? 0,
                    'status' => 'draft',
                    'notes' => $data['notes'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create daily collection report.', [
                'action' => self::class,
                'bank_id' => $data['bank_id'] ?? null,
                'user_id' => $data['user_id'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}