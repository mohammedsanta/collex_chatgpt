<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsWithMultiplePhones
{
    public function execute(int $minimumPhones = 2): Builder
    {
        return Client::query()
            ->has('phones', '>=', $minimumPhones)
            ->with('phones')
            ->orderBy('name');
    }
}