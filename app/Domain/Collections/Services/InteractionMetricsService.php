<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\CaseInteraction;

final class InteractionMetricsService
{
    public function totalDuration(int $debtCaseId): int
    {
        return (int) CaseInteraction::query()
            ->where('debt_case_id', $debtCaseId)
            ->sum('duration_seconds');
    }

    public function countAnswered(int $debtCaseId): int
    {
        return CaseInteraction::query()
            ->where('debt_case_id', $debtCaseId)
            ->where('outcome', 'answered')
            ->count();
    }
}