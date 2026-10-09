<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteComplaint
{
    public function execute(Complaint $complaint): void
    {
        try {
            DB::transaction(function () use ($complaint): void {
                $complaint = Complaint::query()
                    ->lockForUpdate()
                    ->findOrFail($complaint->getKey());

                if (in_array($complaint->status, ['resolved', 'closed'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Resolved or closed complaints cannot be deleted.'
                    );
                }

                $complaint->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete complaint.', [
                'action' => self::class,
                'complaint_id' => $complaint->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}