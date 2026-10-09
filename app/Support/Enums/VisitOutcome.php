<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum VisitOutcome: string
{
    case CLIENT_FOUND = 'client_found';
    case NOT_HOME = 'not_home';
    case REFUSED = 'refused';
    case PROMISED = 'promised';
    case PAID = 'paid';
}