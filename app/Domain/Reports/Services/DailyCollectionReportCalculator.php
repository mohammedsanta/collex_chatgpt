<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Collections\Models\CaseInteraction;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Collections\Models\Visit;
use App\Domain\Payments\Models\Payment;

final class DailyCollectionReportCalculator
{
    public function calculate(int $userId, int $bankId, string $date): array
    {
        return [
            'cases_worked' => CaseInteraction::query()
                ->where('user_id', $userId)
                ->whereDate('occurred_at', $date)
                ->distinct('debt_case_id')
                ->count('debt_case_id'),

            'calls_count' => CaseInteraction::query()
                ->where('user_id', $userId)
                ->where('type', 'call')
                ->whereDate('occurred_at', $date)
                ->count(),

            'visits_count' => Visit::query()
                ->where('user_id', $userId)
                ->whereDate('scheduled_at', $date)
                ->count(),

            'promises_count' => PromiseToPay::query()
                ->where('user_id', $userId)
                ->whereDate('promise_date', $date)
                ->count(),

            'promised_amount' => (float) PromiseToPay::query()
                ->where('user_id', $userId)
                ->whereDate('promise_date', $date)
                ->sum('promised_amount'),

            'collected_amount' => (float) Payment::query()
                ->where('collector_id', $userId)
                ->where('status', 'confirmed')
                ->whereDate('paid_at', $date)
                ->whereHas('debtCase', fn ($query) => $query->where(
                    'bank_id',
                    $bankId
                ))
                ->sum('amount'),
        ];
    }
}