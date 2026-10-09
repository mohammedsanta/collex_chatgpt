<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;

final class FindPaymentByReceiptNumber
{
    public function execute(string $receiptNumber): ?Payment
    {
        return Payment::query()
            ->where('receipt_number', $receiptNumber)
            ->with([
                'debtCase.client',
                'collector',
                'confirmedBy',
                'promise',
            ])
            ->first();
    }
}