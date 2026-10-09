<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsDueBetween
{
    public function execute(string $from, string $to): Builder
    {
        return Complaint::query()
            ->whereBetween('due_at', [$from, $to])
            ->whereIn('status', ['open', 'in_review'])
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->orderBy('due_at');
    }
}