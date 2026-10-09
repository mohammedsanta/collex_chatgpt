<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateVisit
{
    public function execute(
        Visit $visit,
        array $data
    ): Visit {
        try {
            return DB::transaction(function () use (
                $visit,
                $data
            ): Visit {
                $visit = Visit::query()
                    ->lockForUpdate()
                    ->findOrFail($visit->getKey());

                if (! in_array($visit->status, ['scheduled', 'cancelled'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Only scheduled or cancelled visits can be updated.'
                    );
                }

                $visit->update([
                    'scheduled_at' => $data['scheduled_at']
                        ?? $visit->scheduled_at,
                    'address' => $data['address']
                        ?? $visit->address,
                    'latitude' => $data['latitude']
                        ?? $visit->latitude,
                    'longitude' => $data['longitude']
                        ?? $visit->longitude,
                ]);

                return $visit->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update visit.', [
                'action' => self::class,
                'visit_id' => $visit->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}