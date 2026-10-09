<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

final class GetPaymentsByDateRange
{
    public function execute(
        Carbon $from,
        Carbon $to
    ): Builder {
        return Payment::query()
            ->whereBetween('paid_at', [$from, $to])
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->orderByDesc('paid_at');
    }
}