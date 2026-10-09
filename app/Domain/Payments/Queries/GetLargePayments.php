<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetLargePayments
{
    public function execute(float $minimumAmount): Builder
    {
        return Payment::query()
            ->where('amount', '>=', $minimumAmount)
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->orderByDesc('amount');
    }
}