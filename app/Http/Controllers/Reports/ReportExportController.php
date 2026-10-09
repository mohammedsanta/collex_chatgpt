<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Domain\Reports\Actions\CompleteReportExport;
use App\Domain\Reports\Actions\CreateReportExport;
use App\Domain\Reports\Actions\DeleteReportExport;
use App\Domain\Reports\Actions\FailReportExport;
use App\Domain\Reports\Models\ReportExport;
use App\Http\Controllers\Controller;

final class ReportExportController extends Controller
{
    public function store(CreateReportExport $action): ReportExport
    {
        return $action->execute(request()->validate([
            'type' => ['required', 'string', 'max:255'],
            'format' => ['required', 'string', 'max:20'],
            'filters' => ['nullable', 'array'],
        ]));
    }

    public function complete(
        ReportExport $export,
        CompleteReportExport $action
    ): ReportExport {
        return $action->execute($export);
    }

    public function fail(
        ReportExport $export,
        FailReportExport $action
    ): ReportExport {
        return $action->execute($export, request()->validate([
            'error' => ['required', 'string'],
        ]));
    }

    public function destroy(
        ReportExport $export,
        DeleteReportExport $action
    ): void {
        $action->execute($export);
    }
}