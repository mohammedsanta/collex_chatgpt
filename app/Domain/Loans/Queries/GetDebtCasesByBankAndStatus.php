<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByBankAndStatus
{
    public function execute(int $bankId, string $status): Builder
    {
        return DebtCase::query()
            ->where('bank_id', $bankId)
            ->where('status', $status)
            ->with([
                'client',
                'portfolio',
                'loanType',
                'assignedUser',
            ])
            ->latest('created_at');
    }
}