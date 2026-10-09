<?php

declare(strict_types=1);

namespace App\Domain\Payments\Services;

use Illuminate\Support\Str;

final class PaymentReceiptNumberGenerator
{
    public function generate(): string
    {
        $prefix = strtoupper((string) config('collex.receipt_prefix', 'PAY'));
        $prefix = preg_replace('/[^A-Z0-9]/', '', $prefix) ?: 'PAY';
        $prefix = substr($prefix, 0, 3);

        return $prefix.'-'.strtoupper((string) Str::ulid());
    }
}
