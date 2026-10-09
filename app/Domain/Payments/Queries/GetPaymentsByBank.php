<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByBank
{
    public function execute(int $bankId): Builder
    {
        return Payment::query()
            ->whereHas('debtCase', function (Builder $query) use ($bankId): void {
                $query->where('bank_id', $bankId);
            })
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->latest('paid_at');
    }
}