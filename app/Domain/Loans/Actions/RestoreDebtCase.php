<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreDebtCase
{
    public function execute(int $debtCaseId): DebtCase
    {
        try {
            return DB::transaction(function () use ($debtCaseId): DebtCase {
                $debtCase = DebtCase::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($debtCaseId);

                if (! $debtCase->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The debt case is not deleted.'
                    );
                }

                $debtCase->restore();

                return $debtCase->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore debt case.', [
                'action' => self::class,
                'debt_case_id' => $debtCaseId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}