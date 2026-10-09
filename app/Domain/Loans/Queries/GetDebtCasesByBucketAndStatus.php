<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class GetDebtCasesByBucketAndStatus
{
    public function execute(string $bucket, string $status): Builder
    {
        return DebtCase::query()
            ->where('bucket', $bucket)
            ->where('status', $status)
            ->with([
                'client',
                'portfolio',
                'bank',
                'assignedUser',
            ])
            ->latest('created_at');
    }
}