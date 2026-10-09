<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Database\Eloquent\Builder;

final class GetInvalidClientPhones
{
    public function execute(): Builder
    {
        return ClientPhone::query()
            ->where('is_valid', false)
            ->with('client')
            ->latest('updated_at');
    }
}