<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesByDebtCase
{
    public function execute(int $debtCaseId): Builder
    {
        return PromiseToPay::query()
            ->where('debt_case_id', $debtCaseId)
            ->with([
                'user',
                'reviewedBy',
            ])
            ->orderByDesc('promise_date');
    }
}