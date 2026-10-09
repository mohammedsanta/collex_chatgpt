<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByEmployer
{
    public function execute(string $employer): Builder
    {
        return DebtCase::query()
            ->whereHas('client', function (Builder $query) use ($employer): void {
                $query->where('employer_name', 'like', "%{$employer}%");
            })
            ->with(['client', 'assignedUser'])
            ->latest();
    }
}