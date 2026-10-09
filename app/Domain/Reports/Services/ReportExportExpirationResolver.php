<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Reports\Models\ReportExport;

final class ReportExportExpirationResolver
{
    public function isExpired(ReportExport $export): bool
    {
        return $export->expires_at !== null
            && $export->expires_at->isPast();
    }
}