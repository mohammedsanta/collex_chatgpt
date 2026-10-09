<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Loans\Models\DebtCase;

final class CaseAssignmentResolver
{
    public function isAssigned(DebtCase $debtCase): bool
    {
        return $debtCase->assigned_user_id !== null;
    }
}