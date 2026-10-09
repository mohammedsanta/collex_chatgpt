<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class MarkVisitMissed
{
    public function execute(Visit $visit): Visit
    {
        try {
            return DB::transaction(function () use ($visit): Visit {
                $visit = Visit::query()
                    ->lockForUpdate()
                    ->findOrFail($visit->getKey());

                if ($visit->status !== 'scheduled') {
                    throw new \App\Exceptions\DomainException(
                        'Only scheduled visits can be marked as missed.'
                    );
                }

                $visit->update([
                    'status' => 'missed',
                ]);

                return $visit->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to mark visit as missed.', [
                'action' => self::class,
                'visit_id' => $visit->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}