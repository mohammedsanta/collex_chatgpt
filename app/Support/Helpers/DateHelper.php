<?php

declare(strict_types=1);

namespace App\Support\Helpers;

use Carbon\CarbonImmutable;
use DateTimeInterface;

final class DateHelper
{
    public static function startOfDay(DateTimeInterface|string $date): CarbonImmutable
    {
        return CarbonImmutable::parse($date)->startOfDay();
    }

    public static function endOfDay(DateTimeInterface|string $date): CarbonImmutable
    {
        return CarbonImmutable::parse($date)->endOfDay();
    }
}
