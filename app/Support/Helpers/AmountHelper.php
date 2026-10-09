<?php

declare(strict_types=1);

namespace App\Support\Helpers;

final class AmountHelper
{
    public static function normalize(float|int|string|null $amount): float
    {
        return round((float) ($amount ?? 0), 2);
    }
}