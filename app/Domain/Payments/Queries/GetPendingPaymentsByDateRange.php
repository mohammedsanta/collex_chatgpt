<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPendingPaymentsByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return Payment::query()
            ->where('status', 'pending')
            ->whereBetween('paid_at', [$from, $to])
            ->with(['debtCase.client', 'collector', 'promise'])
            ->orderByDesc('paid_at');
    }
}