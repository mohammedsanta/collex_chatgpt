<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByDebtCaseStatus
{
    public function execute(string $caseStatus): Builder
    {
        return Payment::query()
            ->whereHas('debtCase', function (Builder $query) use ($caseStatus): void {
                $query->where('status', $caseStatus);
            })
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'collector',
                'promise',
            ])
            ->latest('paid_at');
    }
}