<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByCreatedDateRange
{
    public function execute(string $from, string $to): Builder
    {
        return Client::query()
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at');
    }
}