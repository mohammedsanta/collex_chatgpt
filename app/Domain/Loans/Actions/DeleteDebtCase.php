<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteDebtCase
{
    public function execute(DebtCase $debtCase): void
    {
        try {
            DB::transaction(function () use ($debtCase): void {
                $debtCase = DebtCase::query()
                    ->lockForUpdate()
                    ->findOrFail($debtCase->getKey());

                if ($debtCase->status === 'paid') {
                    throw new \App\Exceptions\DomainException(
                        'A paid debt case cannot be deleted.'
                    );
                }

                if ($debtCase->collected_amount > 0) {
                    throw new \App\Exceptions\DomainException(
                        'A debt case with collected payments cannot be deleted.'
                    );
                }

                $debtCase->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete debt case.', [
                'action' => self::class,
                'debt_case_id' => $debtCase->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}