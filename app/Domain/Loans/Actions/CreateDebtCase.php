<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateDebtCase
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): DebtCase
    {
        try {
            return DB::transaction(function () use ($data): DebtCase {
                return DebtCase::create([
                    'portfolio_id' => $data['portfolio_id'],
                    'bank_id' => $data['bank_id'],
                    'client_id' => $data['client_id'],
                    'loan_type_id' => $data['loan_type_id'] ?? null,
                    'assigned_user_id' => $data['assigned_user_id'] ?? null,
                    'loan_number' => $data['loan_number'] ?? null,
                    'status' => $data['status'] ?? 'active',
                    'total_debt' => $data['total_debt'] ?? 0,
                    'overdue_amount' => $data['overdue_amount'] ?? 0,
                    'installment_value' => $data['installment_value'] ?? null,
                    'min_installment_diff' => $data['min_installment_diff'] ?? null,
                    'late_fee' => $data['late_fee'] ?? 0,
                    'collected_amount' => 0,
                    'bucket' => $data['bucket'] ?? 0,
                    'dpd' => $data['dpd'] ?? 0,
                    'next_due_date' => $data['next_due_date'] ?? null,
                    'loan_start_date' => $data['loan_start_date'] ?? null,
                    'loan_end_date' => $data['loan_end_date'] ?? null,
                    'last_payment_date' => null,
                    'last_payment_amount' => null,
                    'is_processed' => false,
                    'processed_at' => null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create debt case.', [
                'action' => self::class,
                'portfolio_id' => $data['portfolio_id'] ?? null,
                'bank_id' => $data['bank_id'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}