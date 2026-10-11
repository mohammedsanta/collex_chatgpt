<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;

final class GetPromiseToPayDetails
{
    public function execute(int $promiseId): PromiseToPay
    {
        return PromiseToPay::query()
            ->with([
                'debtCase.client',
                'debtCase.portfolio.bank',
            ])
            ->findOrFail($promiseId);
    }
}
