<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum DebtCaseStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PAID = 'paid';
    case LEGAL = 'legal';
}