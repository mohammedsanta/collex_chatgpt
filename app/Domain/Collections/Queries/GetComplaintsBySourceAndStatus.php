<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsBySourceAndStatus
{
    public function execute(string $source, string $status): Builder
    {
        return Complaint::query()
            ->where('source', $source)
            ->where('status', $status)
            ->with(['bank', 'debtCase.client', 'assignedTo'])
            ->latest();
    }
}