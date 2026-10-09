<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByDateRangeAndStatus
{
    public function execute(
        string $from,
        string $to,
        string $status
    ): Builder {
        return Payment::query()
            ->whereBetween('paid_at', [$from, $to])
            ->where('status', $status)
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->orderByDesc('paid_at');
    }
}