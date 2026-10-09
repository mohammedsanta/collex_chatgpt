<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesDueToday
{
    public function execute(): Builder
    {
        return PromiseToPay::query()
            ->whereDate('promise_date', today())
            ->whereIn('status', ['active', 'review'])
            ->with([
                'debtCase.client',
                'user',
            ])
            ->orderBy('promise_date');
    }
}