<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByCollectorAndDateRange
{
    public function execute(
        int $collectorId,
        string $from,
        string $to
    ): Builder {
        return Payment::query()
            ->where('collector_id', $collectorId)
            ->whereBetween('paid_at', [$from, $to])
            ->with([
                'debtCase.client',
                'confirmedBy',
                'promise',
            ])
            ->orderByDesc('paid_at');
    }
}