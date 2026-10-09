<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignmentService
{
    public function assign(
        int $debtCaseId,
        int $userId,
        ?int $assignedBy = null,
        ?string $reason = null
    ): CaseAssignment {
        try {
            return DB::transaction(function () use (
                $debtCaseId,
                $userId,
                $assignedBy,
                $reason
            ) {
                CaseAssignment::query()
                    ->where('debt_case_id', $debtCaseId)
                    ->whereNull('unassigned_at')
                    ->update([
                        'unassigned_at' => now(),
                    ]);

                return CaseAssignment::query()->create([
                    'debt_case_id' => $debtCaseId,
                    'user_id' => $userId,
                    'assigned_by' => $assignedBy,
                    'assigned_at' => now(),
                    'reason' => $reason,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign debt case.', [
                'debt_case_id' => $debtCaseId,
                'user_id' => $userId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}