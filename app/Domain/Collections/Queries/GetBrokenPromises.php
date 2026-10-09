<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetBrokenPromises
{
    public function execute(): Builder
    {
        return PromiseToPay::query()
            ->where('status', 'broken')
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'user',
                'reviewedBy',
            ])
            ->latest('promise_date');
    }
}