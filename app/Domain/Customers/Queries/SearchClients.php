<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class SearchClients
{
    public function execute(?string $search = null): Builder
    {
        return Client::query()
            ->when(
                filled($search),
                function (Builder $query) use ($search): void {
                    $query->where(function (Builder $query) use ($search): void {
                        $query
                            ->where('code', 'like', "%{$search}%")
                            ->orWhere('national_id', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhereHas(
                                'phones',
                                fn (Builder $phoneQuery) => $phoneQuery
                                    ->where('phone', 'like', "%{$search}%")
                            );
                    });
                }
            )
            ->with(['phones', 'governorate']);
    }
}