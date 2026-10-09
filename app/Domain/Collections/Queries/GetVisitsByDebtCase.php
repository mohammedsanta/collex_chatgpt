<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByDebtCase
{
    public function execute(int $debtCaseId): Builder
    {
        return Visit::query()
            ->where('debt_case_id', $debtCaseId)
            ->with([
                'user',
                'assignedBy',
            ])
            ->orderByDesc('scheduled_at');
    }
}