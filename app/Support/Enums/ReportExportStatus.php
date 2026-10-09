<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum ReportExportStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}