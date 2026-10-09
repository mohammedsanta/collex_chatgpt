<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Database\Eloquent\Builder;

final class SearchInstallmentCompaniesByName
{
    public function execute(string $term): Builder
    {
        return InstallmentCompany::query()
            ->where('name', 'like', '%' . $term . '%')
            ->where('is_active', true)
            ->orderBy('name');
    }
}