<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Database\Eloquent\Builder;

final class GetReportExportsByType
{
    public function execute(string $type): Builder
    {
        return ReportExport::query()
            ->where('type', $type)
            ->with('user')
            ->orderByDesc('created_at');
    }
}