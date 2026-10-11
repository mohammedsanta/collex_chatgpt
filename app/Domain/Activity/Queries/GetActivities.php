<?php

declare(strict_types=1);

namespace App\Domain\Activity\Queries;

use App\Domain\Activity\Models\Activity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

final class GetActivities
{
    public function execute(array $filters = []): LengthAwarePaginator
    {
        return Activity::query()
            ->with('user:id,name,email')
            ->when(
                filled($filters['search'] ?? null),
                fn (Builder $query) => $query->search($filters['search'])
            )
            ->when(
                filled($filters['action'] ?? null),
                fn (Builder $query) => $query->where(
                    'event',
                    $filters['action']
                )
            )
            ->when(
                filled($filters['date_from'] ?? null),
                fn (Builder $query) => $query->whereDate(
                    'created_at',
                    '>=',
                    $filters['date_from']
                )
            )
            ->when(
                filled($filters['date_to'] ?? null),
                fn (Builder $query) => $query->whereDate(
                    'created_at',
                    '<=',
                    $filters['date_to']
                )
            )
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();
    }
}