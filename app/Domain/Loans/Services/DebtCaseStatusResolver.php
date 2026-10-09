<?php

declare(strict_types=1);

namespace App\Domain\Loans\Services;

use App\Domain\Loans\Models\DebtCase;

final class DebtCaseStatusResolver
{
    public function resolve(DebtCase $debtCase): string
    {
        if ((float) $debtCase->collected_amount >= (float) $debtCase->total_debt) {
            return 'paid';
        }

        if ($debtCase->status === 'legal') {
            return 'legal';
        }

        return 'active';
    }
}