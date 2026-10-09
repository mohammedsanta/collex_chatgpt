<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DebtCaseBalanceService
{
    public function remainingBalance(DebtCase $debtCase): float
    {
        return max(
            0,
            (float) $debtCase->total_debt - (float) $debtCase->collected_amount
        );
    }

    public function refreshCollectedAmount(DebtCase $debtCase): DebtCase
    {
        try {
            $collected = $debtCase->payments()
                ->where('status', 'confirmed')
                ->sum('amount');

            $debtCase->update([
                'collected_amount' => $collected ?? '0.00',
            ]);

            return $debtCase->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to refresh debt case balance.', [
                'debt_case_id' => $debtCase->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function isFullyPaid(DebtCase $debtCase): bool
    {
        return $this->remainingBalance($debtCase) <= 0;
    }
}