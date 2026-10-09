<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Domain\Reports\Actions\ApproveDailyCollectionReport;
use App\Domain\Reports\Actions\RejectDailyCollectionReport;
use App\Domain\Reports\Actions\SubmitDailyCollectionReport;
use App\Domain\Reports\Models\DailyCollectionReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\RejectDailyCollectionReportRequest;
use Illuminate\Http\Request;

final class DailyCollectionReportStatusController extends Controller
{
    public function submit(Request $request, DailyCollectionReport $report, SubmitDailyCollectionReport $action): DailyCollectionReport
    {
        $this->authorize('submit', $report);
        return $action->execute($report);
    }

    public function approve(Request $request, DailyCollectionReport $report, ApproveDailyCollectionReport $action): DailyCollectionReport
    {
        $this->authorize('approve', $report);
        return $action->execute($report, (int) $request->user()->getAuthIdentifier());
    }

    public function reject(RejectDailyCollectionReportRequest $request, DailyCollectionReport $report, RejectDailyCollectionReport $action): DailyCollectionReport
    {
        $this->authorize('reject', $report);
        return $action->execute($report, $request->validated('reason'));
    }
}
