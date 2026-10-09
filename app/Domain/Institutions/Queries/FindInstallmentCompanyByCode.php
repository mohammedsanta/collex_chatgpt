<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\InstallmentCompany;

final class FindInstallmentCompanyByCode
{
    public function execute(string $code): ?InstallmentCompany
    {
        return InstallmentCompany::query()
            ->where('code', $code)
            ->first();
    }
}