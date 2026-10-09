<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateMonthlyArchive
{
    public function execute(array $data): MonthlyArchive
    {
        try {
            return DB::transaction(function () use ($data): MonthlyArchive {
                return MonthlyArchive::create([
                    'bank_id' => $data['bank_id'],
                    'portfolio_id' => $data['portfolio_id'] ?? null,
                    'year' => $data['year'],
                    'month' => $data['month'],
                    'cases_count' => $data['cases_count'] ?? 0,
                    'total_debt' => $data['total_debt'] ?? 0,
                    'collected_amount' => $data['collected_amount'] ?? 0,
                    'snapshot_path' => $data['snapshot_path'] ?? null,
                    'archived_by' => $data['archived_by'] ?? null,
                    'archived_at' => $data['archived_at'] ?? now(),
                    'notes' => $data['notes'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create monthly archive.', [
                'action' => self::class,
                'bank_id' => $data['bank_id'] ?? null,
                'portfolio_id' => $data['portfolio_id'] ?? null,
                'year' => $data['year'] ?? null,
                'month' => $data['month'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}