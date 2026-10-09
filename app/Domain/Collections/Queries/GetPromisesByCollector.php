<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Database\Eloquent\Builder;

final class GetPromisesByCollector
{
    public function execute(int $userId): Builder
    {
        return PromiseToPay::query()
            ->where('user_id', $userId)
            ->with([
                'debtCase.client',
                'user',
            ])
            ->orderByDesc('promise_date');
    }
}