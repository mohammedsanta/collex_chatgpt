<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByCollector
{
    public function execute(int $collectorId): Builder
    {
        return Payment::query()
            ->where('collector_id', $collectorId)
            ->with([
                'debtCase.client',
                'promise',
                'confirmedBy',
            ])
            ->orderByDesc('paid_at');
    }
}