<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsWithResolution
{
    public function execute(): Builder
    {
        return Complaint::query()
            ->whereNotNull('resolution')
            ->with(['bank', 'debtCase.client', 'loggedBy', 'assignedTo', 'resolvedBy'])
            ->latest('resolved_at');
    }
}