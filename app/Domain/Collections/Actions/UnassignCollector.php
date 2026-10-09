<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UnassignCollector
{
    public function execute(DebtCase $debtCase): DebtCase
    {
        try {
            return DB::transaction(function () use ($debtCase): DebtCase {
                $debtCase = DebtCase::query()
                    ->lockForUpdate()
                    ->findOrFail($debtCase->getKey());

                $currentAssignment = $debtCase->assignments()
                    ->whereNull('unassigned_at')
                    ->latest('assigned_at')
                    ->lockForUpdate()
                    ->first();

                if ($currentAssignment === null) {
                    throw new \App\Exceptions\DomainException(
                        'This debt case is not currently assigned.'
                    );
                }

                $currentAssignment->update([
                    'unassigned_at' => now(),
                ]);

                $debtCase->update([
                    'assigned_user_id' => null,
                ]);

                return $debtCase->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to unassign collector.', [
                'action' => self::class,
                'debt_case_id' => $debtCase->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}