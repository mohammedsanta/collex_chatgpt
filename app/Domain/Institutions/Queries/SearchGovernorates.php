<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Database\Eloquent\Builder;

final class SearchGovernorates
{
    public function execute(string $term): Builder
    {
        return Governorate::query()
            ->where(function (Builder $query) use ($term): void {
                $query
                    ->where('name', 'like', '%' . $term . '%')
                    ->orWhere('name_en', 'like', '%' . $term . '%');
            })
            ->orderBy('name');
    }
}