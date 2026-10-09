<?php

namespace App\Domain\Payments\Services;

final class PaymentMethodService
{
    public function isCash(string $method): bool
    {
        return $method === 'cash';
    }

    public function isElectronic(string $method): bool
    {
        return in_array($method, [
            'e_wallet',
            'bank_transfer',
            'card',
        ], true);
    }
}