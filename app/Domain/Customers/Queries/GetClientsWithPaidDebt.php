<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsWithPaidDebt
{
    public function execute(): Builder
    {
        return Client::query()
            ->whereHas('debtCases', function (Builder $query): void {
                $query->where('status', 'paid');
            })
            ->with('debtCases')
            ->orderBy('name');
    }
}