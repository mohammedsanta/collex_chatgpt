<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Database\Eloquent\Builder;

final class GetClientPhoneByNumber
{
    public function execute(string $phone): Builder
    {
        return ClientPhone::query()
            ->where('phone', $phone)
            ->with('client');
    }
}