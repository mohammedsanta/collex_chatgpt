<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetRejectedComplaints
{
    public function execute(): Builder
    {
        return Complaint::query()
            ->where('status', 'rejected')
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->latest('updated_at');
    }
}