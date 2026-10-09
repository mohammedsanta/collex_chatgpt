<?php

declare(strict_types=1);

namespace App\Domain\Reports\Policies;

use App\Domain\Employees\Models\User;

final class ReportGenerationPolicy
{
    public function generate(User $user): bool
    {
        return $user->status === 'active';
    }

    public function export(User $user): bool
    {
        return $user->status === 'active';
    }
}