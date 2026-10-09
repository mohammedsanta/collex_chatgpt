<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithOpenComplaint
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereHas('complaints', function (Builder $query): void {
                $query->whereIn('status', ['open', 'in_review']);
            })
            ->with(['client', 'assignedUser', 'complaints'])
            ->latest();
    }
}