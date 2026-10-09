<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RejectComplaint
{
    public function execute(
        Complaint $complaint,
        string $resolution,
        int $resolvedBy,
    ): Complaint {
        try {
            return DB::transaction(function () use (
                $complaint,
                $resolution,
                $resolvedBy,
            ): Complaint {
                $complaint = Complaint::query()
                    ->lockForUpdate()
                    ->findOrFail($complaint->getKey());

                if (in_array($complaint->status, ['resolved', 'rejected', 'closed'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'This complaint can no longer be rejected.'
                    );
                }

                $complaint->update([
                    'status' => 'rejected',
                    'resolution' => $resolution,
                    'resolved_by' => $resolvedBy,
                    'resolved_at' => now(),
                ]);

                return $complaint->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to reject complaint.', [
                'action' => self::class,
                'complaint_id' => $complaint->getKey(),
                'resolved_by' => $resolvedBy,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}