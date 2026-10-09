<?php

declare(strict_types=1);

namespace App\Domain\Loans\Queries;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Builder;

final class SearchDebtCases
{
    public function execute(?string $search = null): Builder
    {
        return DebtCase::query()
            ->with([
                'client',
                'portfolio',
                'bank',
                'loanType',
                'assignedUser',
            ])
            ->when(
                filled($search),
                function (Builder $query) use ($search): void {
                    $query->where(function (Builder $query) use ($search): void {
                        $query
                            ->where('loan_number', 'like', "%{$search}%")
                            ->orWhereHas(
                                'client',
                                fn (Builder $clientQuery) => $clientQuery
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('national_id', 'like', "%{$search}%")
                                    ->orWhere('code', 'like', "%{$search}%")
                            );
                    });
                }
            );
    }
}