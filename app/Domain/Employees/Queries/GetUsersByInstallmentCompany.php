<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class GetUsersByInstallmentCompany
{
    public function execute(int $installmentCompanyId): Builder
    {
        return User::query()
            ->whereHas('installmentCompanies', function (Builder $query) use ($installmentCompanyId): void {
                $query->whereKey($installmentCompanyId);
            })
            ->with([
                'role',
                'supervisor',
                'installmentCompanies',
            ])
            ->orderBy('name');
    }
}