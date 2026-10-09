<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsWithNoActiveDebt
{
    public function execute(): Builder
    {
        return Client::query()
            ->whereDoesntHave('debtCases', function (Builder $query): void {
                $query->where('status', 'active');
            })
            ->orderBy('name');
    }
}