<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByGovernorate
{
    public function execute(int $governorateId): Builder
    {
        return DebtCase::query()
            ->whereHas('client', function (Builder $query) use ($governorateId): void {
                $query->where('governorate_id', $governorateId);
            })
            ->with(['client', 'assignedUser'])
            ->latest();
    }
}