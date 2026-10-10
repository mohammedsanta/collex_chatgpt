<?php

declare(strict_types=1);

namespace App\Http\Controllers\Loans;

use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Actions\CreateDebtCase;
use App\Domain\Loans\Actions\DeleteDebtCase;
use App\Domain\Loans\Actions\RestoreDebtCase;
use App\Domain\Loans\Actions\UpdateDebtCase;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Queries\GetLoans;
use App\Domain\Loans\Queries\GetLoanStatistics;
use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\CreateDebtCaseRequest;
use App\Http\Requests\Loans\UpdateDebtCaseRequest;
use Illuminate\Http\Request;

final class DebtCaseController extends Controller
{
    public function store(CreateDebtCaseRequest $request, CreateDebtCase $action): DebtCase
    {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateDebtCaseRequest $request,
        DebtCase $debtCase,
        UpdateDebtCase $action
    ): DebtCase {
        return $action->execute($debtCase, $request->validated());
    }

    public function destroy(DebtCase $debtCase, DeleteDebtCase $action): void
    {
        $action->execute($debtCase);
    }

    public function restore(DebtCase $debtCase, RestoreDebtCase $action): DebtCase
    {
        return $action->execute($debtCase);
    }

    
    public function index(
        Request $request,
        GetLoans $getLoans,
        GetLoanStatistics $getLoanStatistics
    ){
        $this->authorize('viewAny', DebtCase::class);

        $filters = $request->only([
            'search',
            'bank_id',
            'status',
            'assignment',
        ]);

        $cases = $getLoans
            ->execute($filters)
            ->paginate(15)
            ->withQueryString();

        $statistics = $getLoanStatistics->execute();

        $banks = Bank::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('loans.index', compact(
            'cases',
            'statistics',
            'banks',
            'filters',
        ));
    }

}