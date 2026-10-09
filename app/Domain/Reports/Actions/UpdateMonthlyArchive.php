<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateMonthlyArchive
{
    public function execute(
        MonthlyArchive $archive,
        array $data
    ): MonthlyArchive {
        try {
            return DB::transaction(function () use (
                $archive,
                $data
            ): MonthlyArchive {
                $archive = MonthlyArchive::query()
                    ->lockForUpdate()
                    ->findOrFail($archive->getKey());

                $archive->update([
                    'cases_count' => $data['cases_count']
                        ?? $archive->cases_count,
                    'total_debt' => $data['total_debt']
                        ?? $archive->total_debt,
                    'collected_amount' => $data['collected_amount']
                        ?? $archive->collected_amount,
                    'snapshot_path' => $data['snapshot_path']
                        ?? $archive->snapshot_path,
                    'notes' => $data['notes']
                        ?? $archive->notes,
                ]);

                return $archive->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update monthly archive.', [
                'action' => self::class,
                'archive_id' => $archive->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}