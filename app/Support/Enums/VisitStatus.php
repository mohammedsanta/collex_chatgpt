<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum VisitStatus: string
{
    case SCHEDULED = 'scheduled';
    case COMPLETED = 'completed';
    case MISSED = 'missed';
    case CANCELLED = 'cancelled';
}