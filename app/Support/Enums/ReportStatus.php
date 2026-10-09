<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum ReportStatus: string
{
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}