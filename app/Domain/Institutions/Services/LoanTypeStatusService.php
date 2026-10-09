<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Services;

use App\Domain\Institutions\Models\LoanType;

final class LoanTypeStatusService
{
    public function activate(LoanType $loanType): LoanType
    {
        $loanType->update(['is_active' => true]);

        return $loanType->refresh();
    }

    public function deactivate(LoanType $loanType): LoanType
    {
        $loanType->update(['is_active' => false]);

        return $loanType->refresh();
    }
}