<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetRejectedPayments
{
    public function execute(): Builder
    {
        return Payment::query()
            ->where('status', 'rejected')
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->orderByDesc('paid_at');
    }
}