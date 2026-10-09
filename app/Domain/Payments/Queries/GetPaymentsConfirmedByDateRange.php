<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsConfirmedByDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return Payment::query()
            ->where('status', 'confirmed')
            ->whereBetween('confirmed_at', [$from, $to])
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
            ])
            ->latest('confirmed_at');
    }
}