<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case REJECTED = 'rejected';
}