<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\CreateBank;
use App\Domain\Institutions\Actions\DeleteBank;
use App\Domain\Institutions\Actions\UpdateBank;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\Portfolio;
use App\Http\Controllers\Controller;
use App\Http\Requests\Institutions\CreateBankRequest;
use App\Http\Requests\Institutions\UpdateBankRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class BankController extends Controller
{
    public function index(Request $request): View
    {
        $query = Bank::query()
            ->withCount(['users', 'portfolios'])
            ->withSum('portfolios as portfolios_total_debt', 'total_debt');

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($builder) use ($search): void {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('sector', 'like', "%{$search}%");
            });
        }

        if ($request->input('status') === 'active') {
            $query->where('is_active', true);
        } elseif ($request->input('status') === 'inactive') {
            $query->where('is_active', false);
        }

        $banks = $query->latest('id')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Bank::count(),
            'active' => Bank::where('is_active', true)->count(),
            'inactive' => Bank::where('is_active', false)->count(),
            'portfolios' => Portfolio::whereHas('bank')->count(),
        ];

        return view('banks.index', compact('banks', 'stats'));
    }

    public function create(): View
    {
        return view('banks.create');
    }

    public function store(
        CreateBankRequest $request,
        CreateBank $action
    ): RedirectResponse {
        $bank = $action->execute($request->validated());

        return redirect()
            ->route('banks.show', $bank)
            ->with('success', 'Bank created successfully.');
    }

    public function show(Bank $bank): View
    {
        $bank->loadCount(['users', 'portfolios']);

        $portfolios = $bank->portfolios()
            ->latest('id')
            ->paginate(10, ['*'], 'portfolios_page');

        return view('banks.show', compact('bank', 'portfolios'));
    }

    public function panel(Bank $bank): View
    {
        $bank->loadCount(['users', 'portfolios']);

        $portfolios = $bank->portfolios()
            ->latest('id')
            ->limit(8)
            ->get();

        return view('banks.panel', compact('bank', 'portfolios'));
    }

    public function edit(Bank $bank): View
    {
        return view('banks.edit', compact('bank'));
    }

    public function update(
        UpdateBankRequest $request,
        Bank $bank,
        UpdateBank $action
    ): RedirectResponse {
        $action->execute($bank, $request->validated());

        return redirect()
            ->route('banks.show', $bank)
            ->with('success', 'Bank updated successfully.');
    }

    public function destroy(
        Bank $bank,
        DeleteBank $action
    ): RedirectResponse {
        $action->execute($bank);

        return redirect()
            ->route('banks.index')
            ->with('success', 'Bank deleted successfully.');
    }
}