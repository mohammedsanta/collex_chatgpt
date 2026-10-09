<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Collections\Models\CaseInteraction;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Payments\Models\Payment;

final class PerformanceSnapshotCalculator
{
    public function calculate(
        int $userId,
        int $bankId,
        int $year,
        int $month,
        float $targetAmount
    ): array {
        $casesProcessed = CaseInteraction::query()
            ->where('user_id', $userId)
            ->whereMonth('occurred_at', $month)
            ->whereYear('occurred_at', $year)
            ->distinct('debt_case_id')
            ->count('debt_case_id');

        $promises = PromiseToPay::query()
            ->where('user_id', $userId)
            ->whereMonth('promise_date', $month)
            ->whereYear('promise_date', $year);

        $collected = (float) Payment::query()
            ->where('collector_id', $userId)
            ->where('status', 'confirmed')
            ->whereMonth('paid_at', $month)
            ->whereYear('paid_at', $year)
            ->whereHas('debtCase', fn ($query) => $query->where(
                'bank_id',
                $bankId
            ))
            ->sum('amount');

        return [
            'cases_processed' => $casesProcessed,
            'promises_total' => (clone $promises)->count(),
            'promises_kept' => (clone $promises)
                ->where('status', 'kept')
                ->count(),
            'promises_broken' => (clone $promises)
                ->where('status', 'broken')
                ->count(),
            'collected_amount' => $collected,
            'target_amount' => $targetAmount,
            'efficiency' => $targetAmount > 0
                ? round(($collected / $targetAmount) * 100, 2)
                : 0,
        ];
    }
}