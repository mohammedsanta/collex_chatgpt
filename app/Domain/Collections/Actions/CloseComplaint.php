<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CloseComplaint
{
    public function execute(Complaint $complaint): Complaint
    {
        try {
            return DB::transaction(function () use ($complaint): Complaint {
                $complaint = Complaint::query()
                    ->lockForUpdate()
                    ->findOrFail($complaint->getKey());

                if ($complaint->status !== 'resolved') {
                    throw new \App\Exceptions\DomainException(
                        'Only resolved complaints can be closed.'
                    );
                }

                $complaint->update([
                    'status' => 'closed',
                ]);

                return $complaint->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to close complaint.', [
                'action' => self::class,
                'complaint_id' => $complaint->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}