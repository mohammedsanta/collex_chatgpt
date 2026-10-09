<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByAmountRange
{
    public function execute(float $minimum, float $maximum): Builder
    {
        return Payment::query()
            ->whereBetween('amount', [$minimum, $maximum])
            ->with(['debtCase.client', 'collector'])
            ->orderByDesc('amount');
    }
}