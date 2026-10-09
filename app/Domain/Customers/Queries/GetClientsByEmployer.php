<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByEmployer
{
    public function execute(string $employer): Builder
    {
        return Client::query()
            ->where('employer_name', 'like', '%' . $employer . '%')
            ->with('phones')
            ->orderBy('name');
    }
}