<?php

declare(strict_types=1);

namespace App\Support\Helpers;

final class CollectionHelper
{
    public static function sum(array $values): float
    {
        return round(
            array_sum(array_map('floatval', $values)),
            2
        );
    }
}