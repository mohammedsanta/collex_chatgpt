<?php

declare(strict_types=1);

namespace App\Http\Controllers\Loans;

use App\Domain\Loans\Actions\CreateDebtCase;
use App\Domain\Loans\Actions\DeleteDebtCase;
use App\Domain\Loans\Actions\RestoreDebtCase;
use App\Domain\Loans\Actions\UpdateDebtCase;
use App\Domain\Loans\Models\DebtCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\CreateDebtCaseRequest;
use App\Http\Requests\Loans\UpdateDebtCaseRequest;

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
}