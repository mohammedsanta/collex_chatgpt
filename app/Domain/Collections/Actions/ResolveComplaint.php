<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ResolveComplaint
{
    public function execute(
        Complaint $complaint,
        int $resolvedBy,
        string $resolution,
    ): Complaint {
        try {
            return DB::transaction(function () use (
                $complaint,
                $resolvedBy,
                $resolution,
            ): Complaint {
                $complaint = Complaint::query()
                    ->lockForUpdate()
                    ->findOrFail($complaint->getKey());

                if (in_array($complaint->status, ['resolved', 'rejected', 'closed'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'This complaint is already closed.'
                    );
                }

                $complaint->update([
                    'status' => 'resolved',
                    'resolution' => $resolution,
                    'resolved_by' => $resolvedBy,
                    'resolved_at' => now(),
                ]);

                return $complaint->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to resolve complaint.', [
                'action' => self::class,
                'complaint_id' => $complaint->getKey(),
                'resolved_by' => $resolvedBy,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}