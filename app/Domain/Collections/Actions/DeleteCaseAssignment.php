<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteCaseAssignment
{
    public function execute(CaseAssignment $assignment): void
    {
        try {
            DB::transaction(function () use ($assignment): void {
                $assignment = CaseAssignment::query()
                    ->lockForUpdate()
                    ->findOrFail($assignment->getKey());

                if ($assignment->unassigned_at === null) {
                    throw new \App\Exceptions\DomainException(
                        'An active case assignment cannot be deleted. Unassign it instead.'
                    );
                }

                $assignment->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete case assignment.', [
                'action' => self::class,
                'assignment_id' => $assignment->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}