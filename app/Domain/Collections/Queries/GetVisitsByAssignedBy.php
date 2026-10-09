<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Visit;
use Illuminate\Database\Eloquent\Builder;

final class GetVisitsByAssignedBy
{
    public function execute(int $userId): Builder
    {
        return Visit::query()
            ->where('assigned_by', $userId)
            ->with(['debtCase.client', 'user'])
            ->latest('scheduled_at');
    }
}