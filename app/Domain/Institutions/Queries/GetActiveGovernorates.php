<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveGovernorates
{
    public function execute(): Builder
    {
        return Governorate::query()
            ->orderBy('name');
    }
}