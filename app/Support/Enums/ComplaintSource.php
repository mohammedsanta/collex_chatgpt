<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum ComplaintSource: string
{
    case PHONE = 'phone';
    case WHATSAPP = 'whatsapp';
    case EMAIL = 'email';
    case BANK = 'bank';
    case VISIT = 'visit';
}