<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Loans\Models\DebtCase;
use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignCollector
{
    public function execute(
        DebtCase $debtCase,
        int $userId,
        ?int $assignedBy = null,
        ?string $reason = null,
    ): CaseAssignment {
        try {
            return DB::transaction(function () use (
                $debtCase,
                $userId,
                $assignedBy,
                $reason
            ): CaseAssignment {
                $currentAssignment = $debtCase->assignments()
                    ->whereNull('unassigned_at')
                    ->latest('assigned_at')
                    ->first();

                if ($currentAssignment !== null) {
                    $currentAssignment->update([
                        'unassigned_at' => now(),
                    ]);
                }

                $debtCase->update([
                    'assigned_user_id' => $userId,
                ]);

                return CaseAssignment::create([
                    'debt_case_id' => $debtCase->getKey(),
                    'user_id' => $userId,
                    'assigned_by' => $assignedBy,
                    'assigned_at' => now(),
                    'unassigned_at' => null,
                    'reason' => $reason,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign collector.', [
                'action' => self::class,
                'debt_case_id' => $debtCase->getKey(),
                'user_id' => $userId,
                'assigned_by' => $assignedBy,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}