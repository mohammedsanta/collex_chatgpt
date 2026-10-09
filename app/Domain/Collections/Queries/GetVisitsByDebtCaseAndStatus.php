<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByDebtCaseAndStatus
{
    public function execute(int $debtCaseId, string $status): Builder
    {
        return Visit::query()
            ->where('debt_case_id', $debtCaseId)
            ->where('status', $status)
            ->with([
                'debtCase.client',
                'user',
                'assignedBy',
            ])
            ->orderByDesc('scheduled_at');
    }
}