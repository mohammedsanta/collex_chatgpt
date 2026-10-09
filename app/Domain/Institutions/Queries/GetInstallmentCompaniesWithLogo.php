<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Database\Eloquent\Builder;

final class GetInstallmentCompaniesWithLogo
{
    public function execute(): Builder
    {
        return InstallmentCompany::query()
            ->whereNotNull('logo_path')
            ->orderBy('name');
    }
}