<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByCodeRange
{
    public function execute(string $from, string $to): Builder
    {
        return Client::query()
            ->whereBetween('code', [$from, $to])
            ->orderBy('code');
    }
}