<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteMonthlyArchive
{
    public function execute(MonthlyArchive $archive): void
    {
        try {
            DB::transaction(function () use ($archive): void {
                $archive = MonthlyArchive::query()
                    ->lockForUpdate()
                    ->findOrFail($archive->getKey());

                throw_if(
                    $archive->archived_at !== null,
                    new \App\Exceptions\DomainException(
                        'An archived monthly record cannot be deleted.'
                    )
                );

                $archive->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete monthly archive.', [
                'action' => self::class,
                'archive_id' => $archive->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}