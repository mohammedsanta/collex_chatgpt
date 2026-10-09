<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesWithNoPromise
{
    public function execute(): Builder
    {
        return DebtCase::query()
            ->whereDoesntHave('promisesToPay')
            ->with(['client', 'assignedUser'])
            ->latest();
    }
}