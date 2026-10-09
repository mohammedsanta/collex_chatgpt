<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByCollectorAndStatus
{
    public function execute(int $collectorId, string $status): Builder
    {
        return Payment::query()
            ->where('collector_id', $collectorId)
            ->where('status', $status)
            ->with(['debtCase.client', 'promise'])
            ->latest('paid_at');
    }
}