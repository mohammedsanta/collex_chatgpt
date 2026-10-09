<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesWithOutstandingAmount
{
    public function execute(): Builder
    {
        return PromiseToPay::query()
            ->whereColumn('paid_amount', '<', 'promised_amount')
            ->whereIn('status', ['active', 'review', 'partial'])
            ->with([
                'debtCase.client',
                'user',
            ])
            ->orderBy('promise_date');
    }
}