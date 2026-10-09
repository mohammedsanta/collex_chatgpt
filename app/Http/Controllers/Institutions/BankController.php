<?php

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\CreateBank;
use App\Domain\Institutions\Actions\DeleteBank;
use App\Domain\Institutions\Actions\UpdateBank;
use App\Domain\Institutions\Models\Bank;
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
        abort_unless(
            $request->user()?->hasPermission('banks.view'),
            403
        );

        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status', 'all');

        $banks = Bank::query()
            ->withCount(['users', 'portfolios'])
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('sector', 'like', "%{$search}%");
                });
            })
            ->when($status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($status === 'inactive', fn ($query) => $query->where('is_active', false))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $statistics = [
            'total' => Bank::query()->count(),
            'active' => Bank::query()->where('is_active', true)->count(),
            'inactive' => Bank::query()->where('is_active', false)->count(),
        ];

        return view('banks.index', compact(
            'banks',
            'statistics',
            'search',
            'status'
        ));
    }

    public function create(Request $request): View
    {
        abort_unless(
            $request->user()?->hasPermission('banks.create'),
            403
        );

        return view('banks.create');
    }

    public function store(
        CreateBankRequest $request,
        CreateBank $action
    ): RedirectResponse {
        $bank = $action->execute($request->validated());

        return redirect()
            ->route('banks.show', $bank)
            ->with('status', 'تم إنشاء البنك بنجاح.');
    }

    public function show(Request $request, Bank $bank): View
    {
        abort_unless(
            $request->user()?->hasPermission('banks.view'),
            403
        );

        $bank->loadCount(['users', 'portfolios']);

        $portfolios = $bank->portfolios()
            ->latest()
            ->limit(5)
            ->get();

        return view('banks.show', compact('bank', 'portfolios'));
    }

    public function panel(Request $request, Bank $bank): View
    {
        abort_unless(
            $request->user()?->hasPermission('banks.view'),
            403
        );

        $bank->loadCount(['users', 'portfolios']);

        $portfolios = $bank->portfolios()
            ->latest()
            ->limit(5)
            ->get();

        return view('banks.panel', compact('bank', 'portfolios'));
    }

    public function edit(Request $request, Bank $bank): View
    {
        abort_unless(
            $request->user()?->hasPermission('banks.update'),
            403
        );

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
            ->with('status', 'تم تحديث بيانات البنك بنجاح.');
    }

    public function destroy(
        Request $request,
        Bank $bank,
        DeleteBank $action
    ): RedirectResponse {
        abort_unless(
            $request->user()?->hasPermission('banks.delete'),
            403
        );

        abort_if(
            $bank->is_active,
            422,
            'يجب إيقاف البنك قبل حذفه.'
        );

        $action->execute($bank);

        return redirect()
            ->route('banks.index')
            ->with('status', 'تم حذف البنك بنجاح.');
    }
}