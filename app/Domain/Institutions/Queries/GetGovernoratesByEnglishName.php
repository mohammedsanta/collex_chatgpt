<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Database\Eloquent\Builder;

final class GetGovernoratesByEnglishName
{
    public function execute(string $name): Builder
    {
        return Governorate::query()
            ->where('name_en', 'like', '%' . $name . '%')
            ->orderBy('name_en');
    }
}