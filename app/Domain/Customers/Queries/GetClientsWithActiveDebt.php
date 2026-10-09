<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsWithActiveDebt
{
    public function execute(): Builder
    {
        return Client::query()
            ->whereHas('debtCases', function (Builder $query): void {
                $query->where('status', 'active');
            })
            ->with([
                'phones',
                'debtCases',
            ])
            ->orderBy('name');
    }
}