<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Database\Eloquent\Builder;

final class GetReportExportsByUser
{
    public function execute(int $userId): Builder
    {
        return ReportExport::query()
            ->where('user_id', $userId)
            ->orderByDesc('created_at');
    }
}