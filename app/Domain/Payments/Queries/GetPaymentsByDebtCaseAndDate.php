<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByDebtCaseAndDate
{
    public function execute(int $debtCaseId, string $date): Builder
    {
        return Payment::query()
            ->where('debt_case_id', $debtCaseId)
            ->whereDate('paid_at', $date)
            ->with([
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->latest('paid_at');
    }
}