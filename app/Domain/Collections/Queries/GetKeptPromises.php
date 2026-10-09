<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetKeptPromises
{
    public function execute(): Builder
    {
        return PromiseToPay::query()
            ->where('status', 'kept')
            ->with([
                'debtCase.client',
                'debtCase.bank',
                'user',
                'reviewedBy',
            ])
            ->latest('closed_at');
    }
}