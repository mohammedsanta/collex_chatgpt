<?php

declare(strict_types=1);

namespace App\Support\Helpers;

final class MoneyHelper
{
    public static function normalize(int|float|string $amount): string
    {
        if (! is_numeric($amount)) {
            throw new \InvalidArgumentException('Money amount must be numeric.');
        }
        return number_format((float) $amount, 2, '.', '');
    }

    public static function format(int|float|string $amount, string $currency = 'EGP'): string
    {
        return number_format((float) $amount, 2, '.', ',').' '.$currency;
    }
}
