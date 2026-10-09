<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateCaseAssignment
{
    public function execute(
        CaseAssignment $assignment,
        array $data
    ): CaseAssignment {
        try {
            return DB::transaction(function () use (
                $assignment,
                $data
            ): CaseAssignment {
                $assignment = CaseAssignment::query()
                    ->lockForUpdate()
                    ->findOrFail($assignment->getKey());

                if ($assignment->unassigned_at !== null) {
                    throw new \App\Exceptions\DomainException(
                        'An unassigned case assignment cannot be updated.'
                    );
                }

                $assignment->update([
                    'reason' => $data['reason'] ?? $assignment->reason,
                ]);

                return $assignment->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update case assignment.', [
                'action' => self::class,
                'assignment_id' => $assignment->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}