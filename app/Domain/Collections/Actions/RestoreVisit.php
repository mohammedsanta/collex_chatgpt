<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreVisit
{
    public function execute(int $visitId): Visit
    {
        try {
            return DB::transaction(function () use ($visitId): Visit {
                $visit = Visit::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($visitId);

                if (! $visit->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The visit is not deleted.'
                    );
                }

                $visit->restore();

                return $visit->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore visit.', [
                'action' => self::class,
                'visit_id' => $visitId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}