<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

final class GetOverduePromisesToPay
{
    public function execute(?Carbon $asOf = null): Builder
    {
        $asOf ??= now();

        return PromiseToPay::query()
            ->whereIn('status', ['active', 'review'])
            ->whereDate('promise_date', '<', $asOf->toDateString())
            ->whereColumn('paid_amount', '<', 'promised_amount')
            ->with([
                'debtCase.client',
                'user',
            ])
            ->orderBy('promise_date');
    }
}