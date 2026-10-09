<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\AssignUserToInstallmentCompany;
use App\Domain\Employees\Actions\RemoveUserFromInstallmentCompany;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\AssignUserToInstallmentCompanyRequest;

final class UserInstallmentCompanyController extends Controller
{
    public function assign(
        AssignUserToInstallmentCompanyRequest $request,
        User $user,
        AssignUserToInstallmentCompany $action
    ): void {
        $action->execute($user, $request->validated());
    }

    public function remove(
        AssignUserToInstallmentCompanyRequest $request,
        User $user,
        RemoveUserFromInstallmentCompany $action
    ): void {
        $action->execute($user, $request->validated());
    }
}