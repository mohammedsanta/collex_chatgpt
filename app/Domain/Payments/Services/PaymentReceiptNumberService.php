<?php

namespace App\Domain\Payments\Services;

use App\Domain\Payments\Models\Payment;
use Illuminate\Support\Str;

final class PaymentReceiptNumberService
{
    public function generate(): string
    {
        do {
            $number = 'REC-' . strtoupper(Str::random(12));
        } while (Payment::query()->where('receipt_number', $number)->exists());

        return $number;
    }
}