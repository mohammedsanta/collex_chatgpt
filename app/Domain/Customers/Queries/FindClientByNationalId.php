<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;

final class FindClientByNationalId
{
    public function execute(string $nationalId): ?Client
    {
        return Client::query()
            ->with(['phones', 'governorate'])
            ->where('national_id', $nationalId)
            ->first();
    }
}