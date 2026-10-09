<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateDailyCollectionReport
{
    /** @param array<string, mixed> $data */
    public function execute(array $data): DailyCollectionReport
    {
        try {
            return DB::transaction(fn (): DailyCollectionReport => DailyCollectionReport::query()->create([
                'bank_id' => $data['bank_id'], 'user_id' => $data['user_id'], 'report_date' => $data['report_date'],
                'cases_worked' => (int) $data['cases_worked'], 'calls_count' => (int) $data['calls_count'],
                'visits_count' => (int) $data['visits_count'], 'promises_count' => (int) $data['promises_count'],
                'promised_amount' => $data['promised_amount'], 'collected_amount' => $data['collected_amount'],
                'status' => 'draft', 'submitted_at' => null, 'approved_by' => null, 'approved_at' => null,
                'notes' => $data['notes'] ?? null,
            ]));
        } catch (Throwable $exception) {
            Log::error('Failed to create daily collection report.', ['bank_id' => $data['bank_id'] ?? null, 'exception' => $exception]);
            throw $exception;
        }
    }
}
