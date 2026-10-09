<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;

final class DebtCaseStatusService
{
    public function determine(DebtCase $debtCase): string
    {
        if ((float) $debtCase->collected_amount >= (float) $debtCase->total_debt) {
            return 'paid';
        }

        if ($debtCase->status === 'legal') {
            return 'legal';
        }

        return $debtCase->status === 'inactive' ? 'inactive' : 'active';
    }

    public function refresh(DebtCase $debtCase): DebtCase
    {
        $debtCase->update([
            'status' => $this->determine($debtCase),
        ]);

        return $debtCase->refresh();
    }
}