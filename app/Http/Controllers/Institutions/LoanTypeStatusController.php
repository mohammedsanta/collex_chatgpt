<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\ActivateLoanType;
use App\Domain\Institutions\Actions\DeactivateLoanType;
use App\Domain\Institutions\Models\LoanType;
use App\Http\Controllers\Controller;

final class LoanTypeStatusController extends Controller
{
    public function activate(LoanType $loanType, ActivateLoanType $action): LoanType
    {
        return $action->execute($loanType);
    }

    public function deactivate(LoanType $loanType, DeactivateLoanType $action): LoanType
    {
        return $action->execute($loanType);
    }
}