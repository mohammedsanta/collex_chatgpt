<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreComplaint
{
    public function execute(int $complaintId): Complaint
    {
        try {
            return DB::transaction(function () use ($complaintId): Complaint {
                $complaint = Complaint::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($complaintId);

                if (! $complaint->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The complaint is not deleted.'
                    );
                }

                $complaint->restore();

                return $complaint->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore complaint.', [
                'action' => self::class,
                'complaint_id' => $complaintId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}