<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum PromiseStatus: string
{
    case ACTIVE = 'active';
    case REVIEW = 'review';
    case KEPT = 'kept';
    case PARTIAL = 'partial';
    case BROKEN = 'broken';
}