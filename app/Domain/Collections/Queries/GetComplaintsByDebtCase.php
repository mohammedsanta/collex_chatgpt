<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByDebtCase
{
    public function execute(int $debtCaseId): Builder
    {
        return Complaint::query()
            ->where('debt_case_id', $debtCaseId)
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