<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\CaseAssignment;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveAssignmentsByBank
{
    public function execute(int $bankId): Builder
    {
        return CaseAssignment::query()
            ->whereNull('unassigned_at')
            ->whereHas('debtCase', function (Builder $query) use ($bankId): void {
                $query->where('bank_id', $bankId);
            })
            ->with(['debtCase.client', 'user'])
            ->latest('assigned_at');
    }
}