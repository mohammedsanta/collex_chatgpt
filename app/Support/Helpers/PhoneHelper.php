<?php

declare(strict_types=1);

namespace App\Support\Helpers;

final class PhoneHelper
{
    public static function normalize(string $phone): string
    {
        return preg_replace('/[\s\-\(\)]/', '', trim($phone)) ?? trim($phone);
    }
}