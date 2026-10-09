<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Database\Eloquent\Builder;

final class GetExpiredReportExports
{
    public function execute(): Builder
    {
        return ReportExport::query()
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->with('user')
            ->orderBy('expires_at');
    }
}