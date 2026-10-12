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

    public function submit(
        Request $request,
        string $bank,
        DailyCollectionReport $dailyReport,
        SubmitDailyCollectionReport $action
    ): DailyCollectionReport {
        $this->authorize('submit', $dailyReport);

        abort_unless(
            (int) $dailyReport->bank_id === (int) $bank,
            404
        );

        return $action->execute($dailyReport);
    }



    public function approve(
        Request $request,
        string $bank,
        DailyCollectionReport $dailyReport,
        ApproveDailyCollectionReport $action
    ): DailyCollectionReport {
        $this->authorize('approve', $dailyReport);

        abort_unless(
            (int) $dailyReport->bank_id === (int) $bank,
            404
        );

        return $action->execute(
            $dailyReport,
            (int) $request->user()->getAuthIdentifier()
        );
    }



    public function reject(
        RejectDailyCollectionReportRequest $request,
        string $bank,
        DailyCollectionReport $dailyReport,
        RejectDailyCollectionReport $action
    ): DailyCollectionReport {
        $this->authorize('reject', $dailyReport);

        abort_unless(
            (int) $dailyReport->bank_id === (int) $bank,
            404
        );

        return $action->execute(
            $dailyReport,
            $request->validated('reason')
        );
    }


}
