<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesByDateRangeAndStatus
{
    public function execute(
        string $from,
        string $to,
        string $status
    ): Builder {
        return PromiseToPay::query()
            ->whereBetween('promise_date', [$from, $to])
            ->where('status', $status)
            ->with([
                'debtCase.client',
                'user',
                'reviewedBy',
            ])
            ->orderBy('promise_date');
    }
}