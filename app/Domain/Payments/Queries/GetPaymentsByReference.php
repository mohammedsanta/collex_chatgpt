<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;

final class GetPaymentsByReference
{
    public function execute(string $reference): ?Payment
    {
        return Payment::query()
            ->where('reference', $reference)
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->first();
    }
}