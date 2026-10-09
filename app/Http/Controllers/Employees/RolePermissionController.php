<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\AssignPermissionToRole;
use App\Domain\Employees\Actions\RevokePermissionFromRole;
use App\Domain\Employees\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\AssignPermissionToRoleRequest;

final class RolePermissionController extends Controller
{
    public function assign(
        AssignPermissionToRoleRequest $request,
        Role $role,
        AssignPermissionToRole $action
    ): void {
        $action->execute($role, $request->validated());
    }

    public function revoke(
        AssignPermissionToRoleRequest $request,
        Role $role,
        RevokePermissionFromRole $action
    ): void {
        $action->execute($role, $request->validated());
    }


    
}