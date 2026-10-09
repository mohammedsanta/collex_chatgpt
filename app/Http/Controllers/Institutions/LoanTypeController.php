<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\CreateLoanType;
use App\Domain\Institutions\Actions\DeleteLoanType;
use App\Domain\Institutions\Actions\UpdateLoanType;
use App\Domain\Institutions\Models\LoanType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Institutions\CreateLoanTypeRequest;
use App\Http\Requests\Institutions\UpdateLoanTypeRequest;

final class LoanTypeController extends Controller
{
    public function store(
        CreateLoanTypeRequest $request,
        CreateLoanType $action
    ): LoanType {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateLoanTypeRequest $request,
        LoanType $loanType,
        UpdateLoanType $action
    ): LoanType {
        return $action->execute($loanType, $request->validated());
    }

    public function destroy(
        LoanType $loanType,
        DeleteLoanType $action
    ): void {
        $action->execute($loanType);
    }
}