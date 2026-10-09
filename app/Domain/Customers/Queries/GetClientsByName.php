<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByName
{
    public function execute(string $name): Builder
    {
        return Client::query()
            ->where('name', 'like', '%' . $name . '%')
            ->with('phones')
            ->orderBy('name');
    }
}