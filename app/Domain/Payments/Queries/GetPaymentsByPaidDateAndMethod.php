<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByPaidDateAndMethod
{
    public function execute(string $date, string $method): Builder
    {
        return Payment::query()
            ->whereDate('paid_at', $date)
            ->where('method', $method)
            ->with(['debtCase.client', 'collector'])
            ->orderByDesc('paid_at');
    }
}