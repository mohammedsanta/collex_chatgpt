<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\CreateInstallmentCompany;
use App\Domain\Institutions\Actions\DeleteInstallmentCompany;
use App\Domain\Institutions\Actions\UpdateInstallmentCompany;
use App\Domain\Institutions\Models\InstallmentCompany;
use App\Http\Controllers\Controller;
use App\Http\Requests\Institutions\CreateInstallmentCompanyRequest;
use App\Http\Requests\Institutions\UpdateInstallmentCompanyRequest;

final class InstallmentCompanyController extends Controller
{
    public function store(
        CreateInstallmentCompanyRequest $request,
        CreateInstallmentCompany $action
    ): InstallmentCompany {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateInstallmentCompanyRequest $request,
        InstallmentCompany $company,
        UpdateInstallmentCompany $action
    ): InstallmentCompany {
        return $action->execute($company, $request->validated());
    }

    public function destroy(
        InstallmentCompany $company,
        DeleteInstallmentCompany $action
    ): void {
        $action->execute($company);
    }
}