<?php

declare(strict_types=1);

namespace App\Domain\Archives\Queries;

use App\Domain\Archives\Models\MonthlyArchive;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

final class GetArchives
{
    /**
     * Retrieve monthly archives using the supplied filters.
     *
     * @param array{
     *     search?: string|null,
     *     bank_id?: int|string|null,
     *     year?: int|string|null,
     *     month?: int|string|null
     * } $filters
     */
    public function execute(array $filters = []): LengthAwarePaginator
    {
        $query = MonthlyArchive::query()
            ->with([
                'bank',
                'portfolio',
                'archivedBy',
            ])
            ->when(
                filled($filters['bank_id'] ?? null),
                fn (Builder $query) => $query->where(
                    'bank_id',
                    $filters['bank_id']
                )
            )
            ->when(
                filled($filters['year'] ?? null),
                fn (Builder $query) => $query->where(
                    'year',
                    $filters['year']
                )
            )
            ->when(
                filled($filters['month'] ?? null),
                fn (Builder $query) => $query->where(
                    'month',
                    $filters['month']
                )
            )
            ->when(
                filled($filters['search'] ?? null),
                function (Builder $query) use ($filters): void {
                    $search = trim($filters['search']);

                    $query->where(function (Builder $query) use ($search): void {
                        $query
                            ->where('notes', 'like', "%{$search}%")
                            ->orWhereHas('bank', function (Builder $bank) use ($search): void {
                                $bank->where('name', 'like', "%{$search}%");
                            });
                    });
                }
            )
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->orderByDesc('archived_at');

        return $query
            ->paginate(15)
            ->withQueryString();
    }
}
