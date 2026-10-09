<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Collections\Models\Complaint;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Collections\Models\Visit;
use App\Domain\Customers\Models\Client;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Actions\CreateDebtCase;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Models\Portfolio;
use App\Domain\Reports\Models\DailyCollectionReport;
use App\Domain\Reports\Models\MonthlyArchive;
use App\Domain\Reports\Queries\GetMonthlyArchivesByBank;
use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\CreateDebtCaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class BankWorkspaceController extends Controller
{
public function clients(Request $request, Bank $bank): View
{
    $search = trim((string) $request->query('search', ''));

    $clients = Client::query()
        ->whereHas('debtCases', function ($query) use ($bank) {
            $query->where(function ($cases) use ($bank) {
                $cases->where('bank_id', $bank->id)
                    ->orWhereHas('portfolio', function ($portfolio) use ($bank) {
                        $portfolio->where('bank_id', $bank->id);
                    });
            });
        })
        ->with('governorate')
        ->withCount([
            'debtCases as bank_cases_count' => function ($query) use ($bank) {
                $query->where(function ($cases) use ($bank) {
                    $cases->where('bank_id', $bank->id)
                        ->orWhereHas('portfolio', function ($portfolio) use ($bank) {
                            $portfolio->where('bank_id', $bank->id);
                        });
                });
            },
        ])
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($clients) use ($search) {
                $clients->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('national_id', 'like', "%{$search}%");
            });
        })
        ->orderBy('name')
        ->paginate(15)
        ->withQueryString();

    return view('banks.clients.index', compact('bank', 'clients', 'search'));
}

public function assignClients(Bank $bank): View
{
    $portfolios = $bank->portfolios()
        ->orderByDesc('id')
        ->get();

    // Show existing cases belonging to this bank.
    // Assignment moves selected cases to another portfolio of the same bank.
    $cases = DebtCase::query()
        ->where(function ($query) use ($bank) {
            $query->where('bank_id', $bank->id)
                ->orWhereHas('portfolio', function ($portfolio) use ($bank) {
                    $portfolio->where('bank_id', $bank->id);
                });
        })
        ->with(['client', 'portfolio'])
        ->latest('id')
        ->paginate(25);

    return view('banks.clients.assign', compact('bank', 'portfolios', 'cases'));
}

public function storeClientAssignments(Request $request, Bank $bank)
{
    $validated = $request->validate([
        'portfolio_id' => ['required', 'integer', 'exists:portfolios,id'],
        'case_ids' => ['required', 'array', 'min:1'],
        'case_ids.*' => ['required', 'integer', 'distinct', 'exists:debt_cases,id'],
    ]);

    $portfolio = $bank->portfolios()
        ->whereKey($validated['portfolio_id'])
        ->firstOrFail();

    DB::transaction(function () use ($validated, $bank, $portfolio) {
        $cases = DebtCase::query()
            ->whereIn('id', $validated['case_ids'])
            ->where(function ($query) use ($bank) {
                $query->where('bank_id', $bank->id)
                    ->orWhereHas('portfolio', function ($portfolioQuery) use ($bank) {
                        $portfolioQuery->where('bank_id', $bank->id);
                    });
            })
            ->lockForUpdate()
            ->get();

        if ($cases->count() !== count($validated['case_ids'])) {
            throw ValidationException::withMessages([
                'case_ids' => 'بعض الحالات المحددة لا تتبع هذا البنك.',
            ]);
        }

        foreach ($cases as $case) {
            $case->portfolio_id = $portfolio->id;
            $case->bank_id = $bank->id;
            $case->save();
        }
    });

    return redirect()
        ->route('banks.clients.index', $bank)
        ->with('success', 'تم نقل الحالات المحددة إلى المحفظة بنجاح.');
}


public function distribution(Request $request, Bank $bank): View
{
    $search = trim((string) $request->query('search', ''));

    $portfolios = $bank->portfolios()
        ->withCount('debtCases')
        ->withSum('debtCases', 'total_debt')
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('period_year', 'like', "%{$search}%");
            });
        })
        ->orderByDesc('id')
        ->paginate(15)
        ->withQueryString();

    $stats = [
        'portfolios_count' => $bank->portfolios()->count(),
        'cases_count' => $bank->portfolios()
            ->withCount('debtCases')
            ->get()
            ->sum('debt_cases_count'),
        'total_debt' => $bank->portfolios()
            ->withSum('debtCases', 'total_debt')
            ->get()
            ->sum(fn ($portfolio) => (float) ($portfolio->debt_cases_sum_total_debt ?? 0)),
    ];

    return view('banks.distribution.index', compact(
        'bank',
        'portfolios',
        'stats',
        'search'
    ));
}

    public function assignDistribution(Bank $bank): View
    {
        $portfolios = $bank->portfolios()
            ->withCount('debtCases')
            ->latest('id')
            ->get();

        return view('banks.distribution.index', compact('bank', 'portfolios'));
    }

    public function storeDistribution(Request $request, Bank $bank)
    {
        // Actual case assignment should use the project's debt-case
        // assignment action and its authorization rules.
        return back()->with(
            'error',
            'Choose a portfolio and use the debt-case assignment workflow.'
        );
    }

public function importScope(Bank $bank): View
{
    $portfolios = $bank->portfolios()
        ->orderByDesc('id')
        ->get();

    return view('banks.scope.import', compact(
        'bank',
        'portfolios'
    ));
}

    public function editScope(Bank $bank): View
    {
        $portfolios = $bank->portfolios()->latest('id')->get();

        return view('banks.scope.edit', compact('bank', 'portfolios'));
    }

    public function archives(
        Request $request,
        Bank $bank,
        GetMonthlyArchivesByBank $getArchives
    ): View {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'month' => ['nullable', 'integer', 'between:1,12'],
        ]);

        $search = trim((string) ($filters['search'] ?? ''));
        $year = $filters['year'] ?? null;
        $month = $filters['month'] ?? null;

        // Only retrieve archive records belonging to this bank.
        $query = $getArchives->execute((int) $bank->id);

        $query
            ->when($year, fn ($q) => $q->where('year', $year))
            ->when($month, fn ($q) => $q->where('month', $month))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($records) use ($search) {
                    $records
                        ->where('year', 'like', "%{$search}%")
                        ->orWhere('month', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%")
                        ->orWhereHas('portfolio', function ($portfolio) use ($search) {
                            $portfolio->where('name', 'like', "%{$search}%");
                        });
                });
            });

        $archives = $query
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(15)
            ->withQueryString();

        // Summary cards show totals for all archive records of this bank,
        // independently of the selected filters.
        $summary = \App\Domain\Reports\Models\MonthlyArchive::query()
            ->where('bank_id', $bank->id);

        $stats = [
            'archives_count' => (clone $summary)->count(),
            'cases_count' => (int) (clone $summary)->sum('cases_count'),
            'total_debt' => (float) (clone $summary)->sum('total_debt'),
            'collected_amount' => (float) (clone $summary)->sum('collected_amount'),
        ];

        $years = \App\Domain\Reports\Models\MonthlyArchive::query()
            ->where('bank_id', $bank->id)
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('banks.archives.index', compact(
            'bank',
            'archives',
            'stats',
            'years',
            'search',
            'year',
            'month',
        ));
    }

    public function archive(Bank $bank, MonthlyArchive $archive): View
    {
        abort_unless((int) $archive->bank_id === (int) $bank->id, 404);

        $archive->load([
            'bank',
            'portfolio',
            'archivedBy',
        ]);

        return view('banks.archives.show', compact('bank', 'archive'));
    }

public function promises(Request $request, Bank $bank): View
{
    $search = trim((string) $request->query('search', ''));
    $status = (string) $request->query('status', '');

    $query = PromiseToPay::query()
        ->with([
            'debtCase.client',
            'debtCase.portfolio',
        ])
        ->whereHas('debtCase.portfolio', function ($portfolioQuery) use ($bank) {
            $portfolioQuery->where('bank_id', $bank->id);
        })
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('notes', 'like', "%{$search}%")
                    ->orWhereHas('debtCase', function ($caseQuery) use ($search) {
                        $caseQuery->where('id', 'like', "%{$search}%")
                            ->orWhereHas('client', function ($clientQuery) use ($search) {
                                $clientQuery->where('name', 'like', "%{$search}%");
                            });
                    });
            });
        })
        ->when(
            in_array($status, ['active', 'review', 'kept', 'partial', 'broken'], true),
            fn ($query) => $query->where('status', $status)
        );

    $promises = (clone $query)
        ->latest('id')
        ->paginate(15)
        ->withQueryString();

    $statsQuery = PromiseToPay::query()
        ->whereHas('debtCase.portfolio', function ($portfolioQuery) use ($bank) {
            $portfolioQuery->where('bank_id', $bank->id);
        });

    $stats = [
        'total' => (clone $statsQuery)->count(),
        'active' => (clone $statsQuery)->where('status', 'active')->count(),
        'review' => (clone $statsQuery)->where('status', 'review')->count(),
        'promised_amount' => (float) (clone $statsQuery)
            ->whereIn('status', ['active', 'review'])
            ->sum('promised_amount'),
    ];

    return view('banks.ptp.index', compact(
        'bank',
        'promises',
        'stats',
        'search',
        'status',
    ));
}

    public function createPromise(Bank $bank): View
    {
        $cases = $this->bankCases($bank);

        return view('banks.ptp.create', compact('bank', 'cases'));
    }

    public function editPromise(
        Bank $bank,
        PromiseToPay $promise
    ): View {
        abort_unless(
            (int) $promise->debtCase?->portfolio?->bank_id === (int) $bank->id,
            404
        );

        $cases = $this->bankCases($bank);

        return view('banks.ptp.edit', compact('bank', 'promise', 'cases'));
    }


    public function visits(Request $request, Bank $bank): View
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 15);

        if (! in_array($perPage, [15, 25, 50], true)) {
            $perPage = 15;
        }

        $visits = Visit::query()
            ->whereHas(
                'debtCase.portfolio',
                fn ($query) => $query->where('bank_id', $bank->id)
            )
            ->with(['debtCase.client', 'user'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($visits) use ($search) {
                    $visits->whereHas('debtCase', function ($cases) use ($search) {
                        $cases->where('loan_number', 'like', "%{$search}%")
                            ->orWhereHas('client', function ($clients) use ($search) {
                                $clients->where('name', 'like', "%{$search}%");
                            });
                    });

                    if (ctype_digit($search)) {
                        $visits->orWhere('id', (int) $search);
                    }
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('banks.visits.index', compact('bank', 'visits'));
    }

    public function createVisit(Bank $bank): View
    {
        $cases = $this->bankCases($bank);

        return view('banks.visits.create', compact('bank', 'cases'));
    }

    public function editVisit(Bank $bank, Visit $visit): View
    {
        abort_unless(
            (int) $visit->debtCase?->portfolio?->bank_id === (int) $bank->id,
            404
        );

        $cases = $this->bankCases($bank);

        return view('banks.visits.edit', compact('bank', 'visit', 'cases'));
    }

    public function complaints(Request $request, Bank $bank): View
    {
        $search = trim((string) $request->query('search', ''));

        $perPage = (int) $request->query('per_page', 15);

        if (! in_array($perPage, [15, 25, 50], true)) {
            $perPage = 15;
        }

        $complaints = Complaint::query()
            ->where('bank_id', $bank->id)
            ->with(['client', 'debtCase', 'assignedTo'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($complaints) use ($search) {
                    $complaints
                        ->where('subject', 'like', "%{$search}%")
                        ->orWhereHas('client', function ($clients) use ($search) {
                            $clients->where('name', 'like', "%{$search}%");
                        });

                    if (ctype_digit($search)) {
                        $complaints->orWhere('id', (int) $search);
                    }
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();

        return view(
            'banks.complaints.index',
            compact('bank', 'complaints', 'search', 'perPage')
        );
    }

    public function createComplaint(Bank $bank): View
    {
        $cases = $this->bankCases($bank);

        return view('banks.complaints.create', compact('bank', 'cases'));
    }

    public function complaint(Bank $bank, Complaint $complaint): View
    {
        abort_unless((int) $complaint->bank_id === (int) $bank->id, 404);

        $complaint->load(['client', 'debtCase', 'assignedTo', 'loggedBy']);

        return view('banks.complaints.show', compact('bank', 'complaint'));
    }

    public function editComplaint(Bank $bank, Complaint $complaint): View
    {
        abort_unless((int) $complaint->bank_id === (int) $bank->id, 404);

        $cases = $this->bankCases($bank);

        return view('banks.complaints.edit', compact('bank', 'complaint', 'cases'));
    }

    public function dcr(Bank $bank): View
    {
        $reports = DailyCollectionReport::query()
            ->where('bank_id', $bank->id)
            ->latest('id')
            ->paginate(15);

        return view('banks.dcr.index', compact('bank', 'reports'));
    }

    private function bankCases(Bank $bank)
    {
        return DebtCase::query()
            ->whereHas('portfolio', fn ($query) => $query->where('bank_id', $bank->id))
            ->with(['client', 'portfolio'])
            ->latest('id')
            ->limit(500)
            ->get();
    }

    public function createPortfolio(\App\Domain\Institutions\Models\Bank $bank)
    {
        return view('banks.distribution.create', compact('bank'));
    }

    public function createCase(Bank $bank): View
    {
        $portfolios = $bank->portfolios()
            ->latest('id')
            ->get();

        return view('banks.cases.create', compact('bank', 'portfolios'));
    }

    
    public function storeCase(
        CreateDebtCaseRequest $request,
        Bank $bank,
        CreateDebtCase $action
    ): RedirectResponse {
        $data = $request->validated();

        // The bank is determined by the route, not by user input.
        $data['bank_id'] = $bank->id;

        $action->execute($data);

        return redirect()
            ->route('banks.cases.create', $bank)
            ->with('success', 'تم إنشاء حالة القرض بنجاح.');
    }
    
}