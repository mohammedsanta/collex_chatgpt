<?php

declare(strict_types=1);

namespace App\Support;

final class StaticPromises
{
    public static function statuses(): array { return ['active','review','kept','partial','broken']; }
    private function __construct() {}
}
