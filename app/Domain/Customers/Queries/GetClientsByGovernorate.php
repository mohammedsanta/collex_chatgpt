<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByGovernorate
{
    public function execute(int $governorateId): Builder
    {
        return Client::query()
            ->where('governorate_id', $governorateId)
            ->orderBy('name');
    }
}