<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Collections\Models\Complaint;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Collections\Models\Visit;
use App\Domain\Customers\Models\Client;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Models\Portfolio;
use App\Domain\Reports\Models\DailyCollectionReport;
use App\Domain\Reports\Models\MonthlyArchive;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class BankWorkspaceController extends Controller
{
    public function clients(Bank $bank): View
    {
        $clients = Client::query()
            ->whereHas('debtCases.portfolio', fn ($query) => $query->where('bank_id', $bank->id))
            ->withCount([
                'debtCases as bank_cases_count' => fn ($query) =>
                    $query->whereHas('portfolio', fn ($portfolio) => $portfolio->where('bank_id', $bank->id)),
            ])
            ->paginate(15);

        return view('banks.clients.index', compact('bank', 'clients'));
    }

    public function assignClients(Bank $bank): View
    {
        $portfolios = $bank->portfolios()
            ->latest('id')
            ->get();

        $clients = Client::query()
            ->orderBy('name')
            ->limit(500)
            ->get();

        return view('banks.clients.assign', compact('bank', 'portfolios', 'clients'));
    }

    public function storeClientAssignments(Request $request, Bank $bank)
    {
        // Client-to-bank assignment is represented through debt cases
        // belonging to portfolios for this bank. Do not create a separate
        // client assignment until the business rule and schema are defined.
        return back()->with(
            'error',
            'Assign clients through a portfolio or debt case.'
        );
    }

    public function distribution(Bank $bank): View
    {
        $portfolios = $bank->portfolios()
            ->withCount('debtCases')
            ->latest('id')
            ->paginate(15);

        return view('banks.distribution.index', compact('bank', 'portfolios'));
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
        $portfolios = $bank->portfolios()->latest('id')->get();

        return view('banks.scope.import', compact('bank', 'portfolios'));
    }

    public function editScope(Bank $bank): View
    {
        $portfolios = $bank->portfolios()->latest('id')->get();

        return view('banks.scope.edit', compact('bank', 'portfolios'));
    }

    public function archives(Bank $bank): View
    {
        $archives = MonthlyArchive::query()
            ->whereHas('bank', fn ($query) => $query->whereKey($bank->id))
            ->latest('id')
            ->paginate(15);

        return view('banks.archives.index', compact('bank', 'archives'));
    }

    public function archive(Bank $bank, MonthlyArchive $archive): View
    {
        abort_unless((int) $archive->bank_id === (int) $bank->id, 404);

        return view('banks.archives.show', compact('bank', 'archive'));
    }

    public function promises(Bank $bank): View
    {
        $promises = PromiseToPay::query()
            ->whereHas('debtCase.portfolio', fn ($query) => $query->where('bank_id', $bank->id))
            ->with(['debtCase'])
            ->latest('id')
            ->paginate(15);

        return view('banks.ptp.index', compact('bank', 'promises'));
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

    public function visits(Bank $bank): View
    {
        $visits = Visit::query()
            ->whereHas('debtCase.portfolio', fn ($query) => $query->where('bank_id', $bank->id))
            ->with(['debtCase', 'user'])
            ->latest('id')
            ->paginate(15);

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

    public function complaints(Bank $bank): View
    {
        $complaints = Complaint::query()
            ->where('bank_id', $bank->id)
            ->with(['client', 'debtCase', 'assignedTo'])
            ->latest('id')
            ->paginate(15);

        return view('banks.complaints.index', compact('bank', 'complaints'));
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
}