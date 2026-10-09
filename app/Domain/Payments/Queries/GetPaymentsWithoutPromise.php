<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsWithoutPromise
{
    public function execute(): Builder
    {
        return Payment::query()
            ->whereNull('promise_id')
            ->with(['debtCase.client', 'collector'])
            ->latest('paid_at');
    }
}