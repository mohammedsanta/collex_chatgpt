<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByDebtCaseAndDateRange
{
    public function execute(
        int $debtCaseId,
        string $from,
        string $to
    ): Builder {
        return Payment::query()
            ->where('debt_case_id', $debtCaseId)
            ->whereBetween('paid_at', [$from, $to])
            ->with([
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->orderByDesc('paid_at');
    }
}