<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByNationalIdPrefix
{
    public function execute(string $prefix): Builder
    {
        return Client::query()
            ->where('national_id', 'like', $prefix . '%')
            ->orderBy('national_id');
    }
}