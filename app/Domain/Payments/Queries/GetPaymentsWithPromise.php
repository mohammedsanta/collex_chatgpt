<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsWithPromise
{
    public function execute(): Builder
    {
        return Payment::query()
            ->whereNotNull('promise_id')
            ->with(['debtCase.client', 'collector', 'promise'])
            ->latest('paid_at');
    }
}