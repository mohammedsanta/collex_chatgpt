<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Database\Eloquent\Builder;

final class GetLoanTypes
{
    public function execute(array $filters = []): Builder
    {
        return LoanType::query()
            ->withCount('debtCases')
            ->when(
                filled($filters['search'] ?? null),
                function (Builder $query) use ($filters): void {
                    $term = trim((string) $filters['search']);

                    $query->where('name', 'like', "%{$term}%");
                }
            )
            ->when(
                ($filters['status'] ?? '') === 'active',
                fn (Builder $query) => $query->where('is_active', true)
            )
            ->when(
                ($filters['status'] ?? '') === 'inactive',
                fn (Builder $query) => $query->where('is_active', false)
            )
            ->orderBy('name');
    }
}