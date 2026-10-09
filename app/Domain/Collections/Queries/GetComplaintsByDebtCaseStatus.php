<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByDebtCaseStatus
{
    public function execute(string $caseStatus): Builder
    {
        return Complaint::query()
            ->whereHas('debtCase', function (Builder $query) use ($caseStatus): void {
                $query->where('status', $caseStatus);
            })
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->latest('created_at');
    }
}