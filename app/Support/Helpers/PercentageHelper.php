<?php

declare(strict_types=1);

namespace App\Support\Helpers;

final class PercentageHelper
{
    public static function calculate(float $value, float $total): float
    {
        if ($total <= 0) {
            return 0.0;
        }

        return round(($value / $total) * 100, 2);
    }
}