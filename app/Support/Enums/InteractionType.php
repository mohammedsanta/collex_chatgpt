<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum InteractionType: string
{
    case CALL = 'call';
    case WHATSAPP = 'whatsapp';
    case SMS = 'sms';
    case EMAIL = 'email';
    case VISIT = 'visit';
    case NOTE = 'note';
}