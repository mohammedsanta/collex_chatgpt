<?php

declare(strict_types=1);

namespace App\Domain\Customers\Services;

use App\Domain\Customers\Models\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ClientSearchService
{
    public function search(
        ?string $search,
        int $perPage = 25
    ): LengthAwarePaginator {
        return Client::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('national_id', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate($perPage);
    }
}