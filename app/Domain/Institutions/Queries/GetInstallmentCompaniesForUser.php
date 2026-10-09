<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Database\Eloquent\Builder;

final class GetInstallmentCompaniesForUser
{
    public function execute(int $userId): Builder
    {
        return InstallmentCompany::query()
            ->whereHas('users', function (Builder $query) use ($userId): void {
                $query->whereKey($userId);
            })
            ->orderBy('name');
    }
}