<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum PortfolioStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case ARCHIVED = 'archived';
}