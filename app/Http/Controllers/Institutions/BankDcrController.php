<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Models\Bank;
use App\Domain\Reports\Actions\CreateDailyCollectionReport;
use App\Domain\Reports\Actions\SubmitDailyCollectionReport;
use App\Domain\Reports\Actions\ApproveDailyCollectionReport;
use App\Domain\Reports\Actions\RejectDailyCollectionReport;
use App\Domain\Reports\Models\DailyCollectionReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class BankDcrController extends Controller
{
    public function index(Request $request, Bank $bank): View
    {
        $this->ensureBankAccess($request, $bank);

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,submitted,approved,rejected'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);
        $search = trim((string) ($filters['search'] ?? ''));
        $status = (string) ($filters['status'] ?? '');
        $dateFrom = (string) ($filters['date_from'] ?? '');
        $dateTo = (string) ($filters['date_to'] ?? '');

        $baseQuery = DailyCollectionReport::query()->where('bank_id', $bank->id);

        $reports = (clone $baseQuery)
            ->with(['user:id,name,employee_code', 'approvedBy:id,name'])
            ->when($search !== '', function ($query) use ($search): void {
                $query->whereHas('user', function ($users) use ($search): void {
                    $users->where('name', 'like', "%{$search}%")
                        ->orWhere('employee_code', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ['draft', 'submitted', 'approved', 'rejected'], true), fn ($query) => $query->where('status', $status))
            ->when($dateFrom !== '', fn ($query) => $query->whereDate('report_date', '>=', $dateFrom))
            ->when($dateTo !== '', fn ($query) => $query->whereDate('report_date', '<=', $dateTo))
            ->orderByDesc('report_date')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'today' => (clone $baseQuery)->whereDate('report_date', today())->count(),
            'pending' => (clone $baseQuery)->where('status', 'submitted')->count(),
            'approved' => (clone $baseQuery)->where('status', 'approved')->count(),
            'collected' => (clone $baseQuery)->where('status', 'approved')->sum('collected_amount'),
            'promised' => (clone $baseQuery)->whereIn('status', ['submitted', 'approved'])->sum('promised_amount'),
        ];

        return view('banks.dcr.index', compact('bank', 'reports', 'stats', 'search', 'status', 'dateFrom', 'dateTo'));
    }

    public function create(Request $request, Bank $bank): View
    {
        $this->ensureBankAccess($request, $bank);
        abort_unless($request->user()->can('create', DailyCollectionReport::class), 403);

        return view('banks.dcr.create', compact('bank'));
    }

    public function store(Request $request, Bank $bank, CreateDailyCollectionReport $action): RedirectResponse
    {
        $this->ensureBankAccess($request, $bank);
        abort_unless($request->user()->can('create', DailyCollectionReport::class), 403);

        $validated = $request->validate([
            'report_date' => ['required', 'date', 'before_or_equal:today'],
            'cases_worked' => ['required', 'integer', 'min:0', 'max:1000000'],
            'calls_count' => ['required', 'integer', 'min:0', 'max:1000000'],
            'visits_count' => ['required', 'integer', 'min:0', 'max:1000000'],
            'promises_count' => ['required', 'integer', 'min:0', 'max:1000000'],
            'promised_amount' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'collected_amount' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $validated['bank_id'] = $bank->id;
        $validated['user_id'] = (int) $request->user()->getAuthIdentifier();

        $exists = DailyCollectionReport::query()
            ->where('bank_id', $bank->id)
            ->where('user_id', $validated['user_id'])
            ->whereDate('report_date', $validated['report_date'])
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors([
                'report_date' => 'لديك تقرير مسجل لهذا البنك في هذا التاريخ بالفعل.',
            ]);
        }

        $action->execute($validated);

        return redirect()
            ->route('banks.dcr.index', ['bank' => $bank->id])
            ->with('success', 'تم إنشاء تقرير التحصيل اليومي كمسودة بنجاح.');
    }


    public function submit(Request $request, Bank $bank, DailyCollectionReport $dailyReport, SubmitDailyCollectionReport $action): RedirectResponse
    {
        $this->ensureReportBelongsToBank($request, $bank, $dailyReport);
        $this->authorize('submit', $dailyReport);
        $action->execute($dailyReport);

        return back()->with('success', 'تم إرسال التقرير للمراجعة بنجاح.');
    }

    public function approve(Request $request, Bank $bank, DailyCollectionReport $dailyReport, ApproveDailyCollectionReport $action): RedirectResponse
    {
        $this->ensureReportBelongsToBank($request, $bank, $dailyReport);
        $this->authorize('approve', $dailyReport);
        $action->execute($dailyReport, (int) $request->user()->getAuthIdentifier());

        return back()->with('success', 'تم اعتماد تقرير التحصيل بنجاح.');
    }

    public function reject(Request $request, Bank $bank, DailyCollectionReport $dailyReport, RejectDailyCollectionReport $action): RedirectResponse
    {
        $this->ensureReportBelongsToBank($request, $bank, $dailyReport);
        $this->authorize('reject', $dailyReport);
        $validated = $request->validate(['reason' => ['required', 'string', 'min:3', 'max:2000']]);
        $action->execute($dailyReport, $validated['reason']);

        return back()->with('success', 'تم رفض التقرير وإضافة سبب الرفض.');
    }

    private function ensureReportBelongsToBank(Request $request, Bank $bank, DailyCollectionReport $report): void
    {
        $this->ensureBankAccess($request, $bank);
        abort_unless((int) $report->bank_id === (int) $bank->id, 404);
    }

    private function ensureBankAccess(Request $request, Bank $bank): void
    {
        $user = $request->user();
        abort_unless($user && ($user->is_system_account || $user->banks()->whereKey($bank->id)->exists()), 403);
    }
}
