<?php

declare(strict_types=1);

namespace App\Support\Helpers;

use Carbon\Carbon;

final class DateRangeHelper
{
    public static function start(?string $date): ?Carbon
    {
        return $date ? Carbon::parse($date)->startOfDay() : null;
    }

    public static function end(?string $date): ?Carbon
    {
        return $date ? Carbon::parse($date)->endOfDay() : null;
    }
}