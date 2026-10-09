<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesByAmountRange
{
    public function execute(float $minimum, float $maximum): Builder
    {
        return PromiseToPay::query()
            ->whereBetween('promised_amount', [$minimum, $maximum])
            ->with([
                'debtCase.client',
                'user',
            ])
            ->orderByDesc('promised_amount');
    }
}