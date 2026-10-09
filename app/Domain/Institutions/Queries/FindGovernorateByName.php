<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Governorate;

final class FindGovernorateByName
{
    public function execute(string $name): ?Governorate
    {
        return Governorate::query()
            ->where('name', $name)
            ->first();
    }
}