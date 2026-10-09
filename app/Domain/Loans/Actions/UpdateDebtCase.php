<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateDebtCase
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(
        DebtCase $debtCase,
        array $data,
    ): DebtCase {
        try {
            return DB::transaction(function () use (
                $debtCase,
                $data,
            ): DebtCase {
                $debtCase = DebtCase::query()
                    ->lockForUpdate()
                    ->findOrFail($debtCase->getKey());

                if ($debtCase->status === 'paid') {
                    throw new \App\Exceptions\DomainException(
                        'A paid debt case cannot be updated.'
                    );
                }

                $allowedFields = [
                    'loan_type_id',
                    'loan_number',
                    'status',
                    'total_debt',
                    'overdue_amount',
                    'installment_value',
                    'min_installment_diff',
                    'late_fee',
                    'bucket',
                    'dpd',
                    'next_due_date',
                    'loan_start_date',
                    'loan_end_date',
                ];

                $updates = array_intersect_key(
                    $data,
                    array_flip($allowedFields)
                );

                $debtCase->update($updates);

                return $debtCase->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update debt case.', [
                'action' => self::class,
                'debt_case_id' => $debtCase->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}