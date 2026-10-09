<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByUpdatedDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return Client::query()
            ->whereBetween('updated_at', [$from, $to])
            ->orderBy('updated_at');
    }
}