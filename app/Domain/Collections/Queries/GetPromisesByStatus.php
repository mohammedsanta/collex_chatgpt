<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesByStatus
{
    public function execute(string $status): Builder
    {
        return PromiseToPay::query()
            ->where('status', $status)
            ->with([
                'debtCase.client',
                'user',
                'reviewedBy',
            ])
            ->orderBy('promise_date');
    }
}