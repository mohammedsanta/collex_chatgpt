<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByBank
{
    public function execute(int $bankId): Builder
    {
        return Visit::query()
            ->whereHas('debtCase', function (Builder $query) use ($bankId): void {
                $query->where('bank_id', $bankId);
            })
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'user',
                'assignedBy',
            ])
            ->latest('scheduled_at');
    }
}