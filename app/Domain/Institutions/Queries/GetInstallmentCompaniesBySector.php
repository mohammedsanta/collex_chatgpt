<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Database\Eloquent\Builder;

final class GetInstallmentCompaniesBySector
{
    public function execute(string $sector): Builder
    {
        return InstallmentCompany::query()
            ->where('sector', $sector)
            ->where('is_active', true)
            ->orderBy('name');
    }
}