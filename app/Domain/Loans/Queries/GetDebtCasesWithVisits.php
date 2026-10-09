<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithVisits
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereHas('visits')
            ->with(['client', 'assignedUser', 'visits'])
            ->latest();
    }
}