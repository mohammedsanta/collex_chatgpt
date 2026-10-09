<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetOpenComplaintsByBank
{
    public function execute(int $bankId): Builder
    {
        return Complaint::query()
            ->where('bank_id', $bankId)
            ->whereIn('status', ['open', 'in_review'])
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
            ])
            ->orderByDesc('priority')
            ->orderBy('due_at');
    }
}