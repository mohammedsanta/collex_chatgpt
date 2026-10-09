<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\ActivateInstallmentCompany;
use App\Domain\Institutions\Actions\DeactivateInstallmentCompany;
use App\Domain\Institutions\Models\InstallmentCompany;
use App\Http\Controllers\Controller;

final class InstallmentCompanyStatusController extends Controller
{
    public function activate(
        InstallmentCompany $company,
        ActivateInstallmentCompany $action
    ): InstallmentCompany {
        return $action->execute($company);
    }

    public function deactivate(
        InstallmentCompany $company,
        DeactivateInstallmentCompany $action
    ): InstallmentCompany {
        return $action->execute($company);
    }
}