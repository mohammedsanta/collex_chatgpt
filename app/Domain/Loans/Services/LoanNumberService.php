<?php

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;

final class LoanNumberService
{
    public function exists(?string $loanNumber): bool
    {
        if (!$loanNumber) {
            return false;
        }

        return DebtCase::query()
            ->where('loan_number', $loanNumber)
            ->exists();
    }
}