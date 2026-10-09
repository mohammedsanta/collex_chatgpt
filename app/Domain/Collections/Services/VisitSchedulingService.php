<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\Log;
use Throwable;

final class VisitSchedulingService
{
    public function reschedule(Visit $visit, \DateTimeInterface $scheduledAt): Visit
    {
        try {
            $visit->update([
                'scheduled_at' => $scheduledAt,
                'status' => 'scheduled',
            ]);

            return $visit->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to reschedule visit.', [
                'visit_id' => $visit->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}