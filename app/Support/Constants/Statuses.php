<?php

declare(strict_types=1);

namespace App\Support\Constants;

final class Statuses
{
    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';
    public const SUSPENDED = 'suspended';
    public const PENDING = 'pending';
    public const CONFIRMED = 'confirmed';
    public const REJECTED = 'rejected';
    private function __construct() {}
}
