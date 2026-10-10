<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\CreateLoanType;
use App\Domain\Institutions\Actions\DeleteLoanType;
use App\Domain\Institutions\Actions\UpdateLoanType;
use App\Domain\Institutions\Models\LoanType;
use App\Domain\Institutions\Queries\GetLoanTypes;
use App\Domain\Institutions\Queries\GetLoanTypeStatistics;
use App\Http\Controllers\Controller;
use App\Http\Requests\Institutions\CreateLoanTypeRequest;
use App\Http\Requests\Institutions\UpdateLoanTypeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class LoanTypeController extends Controller
{
    public function index(
        Request $request,
        GetLoanTypes $getLoanTypes,
        GetLoanTypeStatistics $getStatistics
    ): View {
        $this->authorize('viewAny', LoanType::class);

        $filters = $request->only(['search', 'status']);

        $loanTypes = $getLoanTypes
            ->execute($filters)
            ->paginate(15)
            ->withQueryString();

        $statistics = $getStatistics->execute();

        return view('loan-types.index', compact(
            'loanTypes',
            'statistics',
            'filters'
        ));
    }

    public function create(): View
    {
        $this->authorize('create', LoanType::class);

        return view('loan-types.create');
    }

    public function store(
        CreateLoanTypeRequest $request,
        CreateLoanType $action
    ): RedirectResponse|LoanType {
        $loanType = $action->execute($request->validated());

        if ($request->expectsJson()) {
            return $loanType;
        }

        return redirect()
            ->route('loan-types.index')
            ->with('status', 'تم إنشاء نوع القرض بنجاح.');
    }

    public function edit(LoanType $loanType): View
    {
        $this->authorize('update', $loanType);

        return view('loan-types.edit', compact('loanType'));
    }

    public function update(
        UpdateLoanTypeRequest $request,
        LoanType $loanType,
        UpdateLoanType $action
    ): RedirectResponse|LoanType {
        $updated = $action->execute(
            $loanType,
            $request->validated()
        );

        if ($request->expectsJson()) {
            return $updated;
        }

        return redirect()
            ->route('loan-types.index')
            ->with('status', 'تم تحديث نوع القرض بنجاح.');
    }

    public function destroy(
        Request $request,
        LoanType $loanType,
        DeleteLoanType $action
    ): ?RedirectResponse {
        $this->authorize('delete', $loanType);

        $action->execute($loanType);

        if ($request->expectsJson()) {
            return null;
        }

        return redirect()
            ->route('loan-types.index')
            ->with('status', 'تم حذف نوع القرض بنجاح.');
    }
}