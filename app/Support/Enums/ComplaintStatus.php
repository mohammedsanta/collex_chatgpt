<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum ComplaintStatus: string
{
    case OPEN = 'open';
    case IN_REVIEW = 'in_review';
    case RESOLVED = 'resolved';
    case REJECTED = 'rejected';
    case CLOSED = 'closed';
}