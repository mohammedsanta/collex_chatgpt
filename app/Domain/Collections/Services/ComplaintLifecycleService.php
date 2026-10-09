<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ComplaintLifecycleService
{
    public function resolve(
        Complaint $complaint,
        int $userId,
        string $resolution
    ): Complaint {
        try {
            $complaint->update([
                'status' => 'resolved',
                'resolution' => $resolution,
                'resolved_by' => $userId,
                'resolved_at' => now(),
            ]);

            return $complaint->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to resolve complaint.', [
                'complaint_id' => $complaint->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}