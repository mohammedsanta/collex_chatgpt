<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ListGovernorates
{
    public function execute(string $search = ''): LengthAwarePaginator
    {
        return Governorate::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('name_en', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();
    }
}
