<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Database\Eloquent\Builder;

final class GetReportExportsByFormat
{
    public function execute(string $format): Builder
    {
        return ReportExport::query()
            ->where('format', $format)
            ->with('user')
            ->orderByDesc('created_at');
    }
}