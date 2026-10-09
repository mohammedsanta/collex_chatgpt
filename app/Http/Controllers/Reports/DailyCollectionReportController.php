<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Domain\Reports\Actions\CreateDailyCollectionReport;
use App\Domain\Reports\Actions\DeleteDailyCollectionReport;
use App\Domain\Reports\Actions\UpdateDailyCollectionReport;
use App\Domain\Reports\Models\DailyCollectionReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\CreateDailyCollectionReportRequest;
use App\Http\Requests\Reports\UpdateDailyCollectionReportRequest;
use Illuminate\Http\Request;

final class DailyCollectionReportController extends Controller
{
    public function store(CreateDailyCollectionReportRequest $request, CreateDailyCollectionReport $action): DailyCollectionReport
    {
        $user = $request->user();
        $bankId = (int) $request->validated('bank_id');
        abort_unless($user->is_system_account || $user->banks()->whereKey($bankId)->exists(), 403);
        return $action->execute($request->validated() + ['user_id' => (int) $user->getAuthIdentifier()]);
    }

    public function update(UpdateDailyCollectionReportRequest $request, DailyCollectionReport $report, UpdateDailyCollectionReport $action): DailyCollectionReport
    {
        return $action->execute($report, $request->validated());
    }

    public function destroy(Request $request, DailyCollectionReport $report, DeleteDailyCollectionReport $action): void
    {
        $this->authorize('delete', $report);
        $action->execute($report);
    }
}
