<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CompleteVisit
{
    public function execute(
        Visit $visit,
        string $outcome,
        ?string $notes = null,
        ?float $latitude = null,
        ?float $longitude = null,
    ): Visit {
        try {
            return DB::transaction(function () use (
                $visit,
                $outcome,
                $notes,
                $latitude,
                $longitude,
            ): Visit {
                $visit = Visit::query()
                    ->lockForUpdate()
                    ->findOrFail($visit->getKey());

                if ($visit->status !== 'scheduled') {
                    throw new \App\Exceptions\DomainException(
                        'Only scheduled visits can be completed.'
                    );
                }

                $visit->update([
                    'status' => 'completed',
                    'visited_at' => now(),
                    'outcome' => $outcome,
                    'notes' => $notes ?? $visit->notes,
                    'latitude' => $latitude ?? $visit->latitude,
                    'longitude' => $longitude ?? $visit->longitude,
                ]);

                return $visit->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to complete visit.', [
                'action' => self::class,
                'visit_id' => $visit->getKey(),
                'outcome' => $outcome,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}