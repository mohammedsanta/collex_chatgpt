<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Database\Eloquent\Builder;

final class GetValidClientPhones
{
    public function execute(int $clientId): Builder
    {
        return ClientPhone::query()
            ->where('client_id', $clientId)
            ->where('is_valid', true)
            ->orderBy('label')
            ->orderBy('phone');
    }
}