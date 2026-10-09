<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateComplaint
{
    public function execute(
        Complaint $complaint,
        array $data
    ): Complaint {
        try {
            return DB::transaction(function () use (
                $complaint,
                $data
            ): Complaint {
                $complaint = Complaint::query()
                    ->lockForUpdate()
                    ->findOrFail($complaint->getKey());

                if (! in_array($complaint->status, ['open', 'in_review'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'Only open or in-review complaints can be updated.'
                    );
                }

                $complaint->update([
                    'subject' => $data['subject']
                        ?? $complaint->subject,
                    'description' => $data['description']
                        ?? $complaint->description,
                    'source' => $data['source']
                        ?? $complaint->source,
                    'priority' => $data['priority']
                        ?? $complaint->priority,
                    'due_at' => $data['due_at']
                        ?? $complaint->due_at,
                ]);

                return $complaint->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update complaint.', [
                'action' => self::class,
                'complaint_id' => $complaint->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}