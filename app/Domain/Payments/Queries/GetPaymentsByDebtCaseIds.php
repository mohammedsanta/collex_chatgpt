<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByDebtCaseIds
{
    public function execute(array $debtCaseIds): Builder
    {
        return Payment::query()
            ->whereIn('debt_case_id', $debtCaseIds)
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
            ])
            ->latest('paid_at');
    }
}