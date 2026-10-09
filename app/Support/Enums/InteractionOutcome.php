<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum InteractionOutcome: string
{
    case ANSWERED = 'answered';
    case NO_ANSWER = 'no_answer';
    case WRONG_NUMBER = 'wrong_number';
    case REFUSED = 'refused';
    case PROMISED = 'promised';
    case PAID = 'paid';
}