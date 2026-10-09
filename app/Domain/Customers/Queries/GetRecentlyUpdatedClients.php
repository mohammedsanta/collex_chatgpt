<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetRecentlyUpdatedClients
{
    public function execute(int $limit = 50): Builder
    {
        return Client::query()
            ->latest('updated_at')
            ->limit($limit);
    }
}