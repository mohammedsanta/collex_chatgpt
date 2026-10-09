<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveInstallmentCompanies
{
    public function execute(): Builder
    {
        return InstallmentCompany::query()
            ->where('is_active', true)
            ->orderBy('name');
    }
}