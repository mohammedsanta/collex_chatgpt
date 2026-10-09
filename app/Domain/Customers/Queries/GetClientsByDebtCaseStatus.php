<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByDebtCaseStatus
{
    public function execute(string $status): Builder
    {
        return Client::query()
            ->whereHas('debtCases', function (Builder $query) use ($status): void {
                $query->where('status', $status);
            })
            ->with('debtCases')
            ->orderBy('name');
    }
}