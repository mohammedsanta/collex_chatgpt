<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;

final class FindClientByCode
{
    public function execute(string $code): ?Client
    {
        return Client::query()
            ->with(['phones', 'governorate'])
            ->where('code', $code)
            ->first();
    }
}