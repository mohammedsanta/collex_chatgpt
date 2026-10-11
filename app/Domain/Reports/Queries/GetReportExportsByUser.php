<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Employees\Models\User;
use App\Domain\Reports\Models\ReportExport;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class GetReportExportsByUser
{
    public function __invoke(
        User $user,
        array $filters = [],
    ): LengthAwarePaginator {
        return ReportExport::query()
            ->where('user_id', $user->getKey())
            ->when(
                filled($filters['search'] ?? null),
                fn ($query) => $query->where(
                    'id',
                    (int) $filters['search'],
                ),
            )
            ->when(
                filled($filters['type'] ?? null),
                fn ($query) => $query->where('type', $filters['type']),
            )
            ->when(
                filled($filters['status'] ?? null),
                fn ($query) => $query->where('status', $filters['status']),
            )
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();
    }
}