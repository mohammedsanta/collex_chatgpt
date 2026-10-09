<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesByBank
{
    public function execute(int $bankId): Builder
    {
        return PromiseToPay::query()
            ->whereHas('debtCase', function (Builder $query) use ($bankId): void {
                $query->where('bank_id', $bankId);
            })
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'user',
            ])
            ->latest('promise_date');
    }
}