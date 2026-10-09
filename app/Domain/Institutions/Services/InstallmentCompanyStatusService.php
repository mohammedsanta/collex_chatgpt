<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Services;

use App\Domain\Institutions\Models\InstallmentCompany;

final class InstallmentCompanyStatusService
{
    public function activate(InstallmentCompany $company): InstallmentCompany
    {
        $company->update(['is_active' => true]);

        return $company->refresh();
    }

    public function deactivate(InstallmentCompany $company): InstallmentCompany
    {
        $company->update(['is_active' => false]);

        return $company->refresh();
    }
}