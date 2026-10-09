<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;

final class FindClientByPhone
{
    public function execute(string $phone): ?Client
    {
        return Client::query()
            ->with(['phones', 'governorate'])
            ->whereHas('phones', function ($query) use ($phone): void {
                $query->where('phone', $phone);
            })
            ->first();
    }
}