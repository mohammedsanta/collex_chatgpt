<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignComplaint
{
    public function execute(
        Complaint $complaint,
        int $assignedTo,
    ): Complaint {
        try {
            return DB::transaction(function () use (
                $complaint,
                $assignedTo,
            ): Complaint {
                $complaint = Complaint::query()
                    ->lockForUpdate()
                    ->findOrFail($complaint->getKey());

                if (in_array($complaint->status, ['resolved', 'rejected', 'closed'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'A closed complaint cannot be assigned.'
                    );
                }

                $complaint->update([
                    'assigned_to' => $assignedTo,
                    'status' => 'in_review',
                ]);

                return $complaint->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign complaint.', [
                'action' => self::class,
                'complaint_id' => $complaint->getKey(),
                'assigned_to' => $assignedTo,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}