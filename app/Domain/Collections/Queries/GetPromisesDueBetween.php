<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesDueBetween
{
    public function execute(string $from, string $to): Builder
    {
        return PromiseToPay::query()
            ->whereBetween('promise_date', [$from, $to])
            ->whereIn('status', ['active', 'review'])
            ->with([
                'debtCase.client',
                'user',
            ])
            ->orderBy('promise_date');
    }
}