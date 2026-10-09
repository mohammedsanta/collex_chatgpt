<?php

declare(strict_types=1);

namespace App\Support\Constants;

final class RoleLevels
{
    public const COLLECTOR = 20;
    public const AUDITOR = 40;
    public const SUPERVISOR = 50;
    public const ADMIN = 80;
    public const SUPER_ADMIN = 100;
    private function __construct() {}
}
