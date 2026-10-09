<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetConfirmedPaymentsByMethod
{
    public function execute(string $method): Builder
    {
        return Payment::query()
            ->where('status', 'confirmed')
            ->where('method', $method)
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
            ])
            ->latest('confirmed_at');
    }
}