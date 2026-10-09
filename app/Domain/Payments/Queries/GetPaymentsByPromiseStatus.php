<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByPromiseStatus
{
    public function execute(string $promiseStatus): Builder
    {
        return Payment::query()
            ->whereHas('promise', function (Builder $query) use ($promiseStatus): void {
                $query->where('status', $promiseStatus);
            })
            ->with([
                'debtCase.client',
                'collector',
                'promise',
            ])
            ->latest('paid_at');
    }
}