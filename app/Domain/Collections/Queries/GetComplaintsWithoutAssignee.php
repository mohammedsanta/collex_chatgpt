<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsWithoutAssignee
{
    public function execute(): Builder
    {
        return Complaint::query()
            ->whereNull('assigned_to')
            ->with(['bank', 'debtCase.client', 'loggedBy'])
            ->orderByDesc('created_at');
    }
}