<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;

final class GetComplaintsByBank
{
    public function execute(int $bankId): Builder
    {
        return Complaint::query()
            ->where('bank_id', $bankId)
            ->with([
                'bank',
                'debtCase.client',
                'loggedBy',
                'assignedTo',
                'resolvedBy',
            ])
            ->orderByDesc('created_at');
    }
}