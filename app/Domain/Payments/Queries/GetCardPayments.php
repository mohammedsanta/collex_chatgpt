<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetCardPayments
{
    public function execute(): Builder
    {
        return Payment::query()
            ->where('method', 'card')
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
            ])
            ->latest('paid_at');
    }
}