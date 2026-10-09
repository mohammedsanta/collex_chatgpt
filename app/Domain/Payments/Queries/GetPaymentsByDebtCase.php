<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByDebtCase
{
    public function execute(int $debtCaseId): Builder
    {
        return Payment::query()
            ->where('debt_case_id', $debtCaseId)
            ->with([
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->latest('paid_at');
    }
}