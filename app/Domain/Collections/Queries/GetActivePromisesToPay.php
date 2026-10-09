<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetActivePromisesToPay
{
    public function execute(): Builder
    {
        return PromiseToPay::query()
            ->where('status', 'active')
            ->with([
                'debtCase.client',
                'user',
            ])
            ->orderBy('promise_date');
    }
}