<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use Illuminate\Database\Eloquent\Builder;

final class GetLoans
{
    public function __construct(
        private readonly SearchDebtCases $searchDebtCases,
    ) {}

    public function execute(array $filters = []): Builder
    {
        return $this->searchDebtCases
            ->execute($filters['search'] ?? null)
            ->when(
                !empty($filters['bank_id']),
                fn (Builder $query) => $query->where(
                    'bank_id',
                    $filters['bank_id']
                )
            )
            ->when(
                !empty($filters['status']),
                fn (Builder $query) => $filters['status'] === 'paid'
                    ? $query->whereRaw('collected_amount >= total_debt')
                    : $query->where('status', $filters['status'])
            )
            ->when(
                ($filters['assignment'] ?? null) === 'assigned',
                fn (Builder $query) => $query->whereNotNull('assigned_user_id')
            )
            ->when(
                ($filters['assignment'] ?? null) === 'unassigned',
                fn (Builder $query) => $query->whereNull('assigned_user_id')
            )
            ->orderByDesc('overdue_amount')
            ->orderByDesc('id');
    }
}
