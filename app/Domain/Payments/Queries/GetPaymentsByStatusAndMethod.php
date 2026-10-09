<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsByStatusAndMethod
{
    public function execute(string $status, string $method): Builder
    {
        return Payment::query()
            ->where('status', $status)
            ->where('method', $method)
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
            ])
            ->latest('paid_at');
    }
}