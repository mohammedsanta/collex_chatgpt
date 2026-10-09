<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByPhone
{
    public function execute(string $phone): Builder
    {
        return Client::query()
            ->whereHas('phones', function (Builder $query) use ($phone): void {
                $query->where('phone', $phone);
            })
            ->with('phones')
            ->orderBy('name');
    }
}