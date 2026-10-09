<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Database\Eloquent\Builder;

final class GetReportExportsByStatus
{
    public function execute(string $status): Builder
    {
        return ReportExport::query()
            ->where('status', $status)
            ->with('user')
            ->orderByDesc('created_at');
    }
}