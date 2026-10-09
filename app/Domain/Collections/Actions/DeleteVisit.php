<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteVisit
{
    public function execute(Visit $visit): void
    {
        try {
            DB::transaction(function () use ($visit): void {
                $visit = Visit::query()
                    ->lockForUpdate()
                    ->findOrFail($visit->getKey());

                if (! in_array($visit->status, ['scheduled', 'cancelled'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Completed or missed visits cannot be deleted.'
                    );
                }

                $visit->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete visit.', [
                'action' => self::class,
                'visit_id' => $visit->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}