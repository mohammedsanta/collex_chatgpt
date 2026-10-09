<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\Log;
use Throwable;

final class VisitOutcomeService
{
    public function complete(
        Visit $visit,
        string $outcome,
        ?string $notes = null
    ): Visit {
        try {
            $visit->update([
                'status' => 'completed',
                'visited_at' => now(),
                'outcome' => $outcome,
                'notes' => $notes,
            ]);

            return $visit->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to complete visit.', [
                'visit_id' => $visit->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}