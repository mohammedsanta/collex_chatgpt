<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPendingPaymentsByCollector
{
    public function execute(int $collectorId): Builder
    {
        return Payment::query()
            ->where('collector_id', $collectorId)
            ->where('status', 'pending')
            ->with([
                'debtCase.client',
                'collector',
                'promise',
            ])
            ->latest('paid_at');
    }
}