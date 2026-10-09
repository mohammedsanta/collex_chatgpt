<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByLoggedUser
{
    public function execute(int $userId): Builder
    {
        return Complaint::query()
            ->where('logged_by', $userId)
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->latest('created_at');
    }
}