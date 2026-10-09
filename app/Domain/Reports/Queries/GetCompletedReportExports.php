<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Database\Eloquent\Builder;

final class GetCompletedReportExports
{
    public function execute(): Builder
    {
        return ReportExport::query()
            ->where('status', 'completed')
            ->with('user')
            ->orderByDesc('generated_at');
    }
}