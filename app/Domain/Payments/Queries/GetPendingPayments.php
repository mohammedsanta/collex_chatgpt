<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPendingPayments
{
    public function execute(): Builder
    {
        return Payment::query()
            ->where('status', 'pending')
            ->with([
                'debtCase.client',
                'collector',
                'promise',
            ])
            ->orderBy('paid_at');
    }
}