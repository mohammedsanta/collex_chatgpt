<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\CreateRole;
use App\Domain\Employees\Actions\DeleteRole;
use App\Domain\Employees\Actions\UpdateRole;
use App\Domain\Employees\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateRoleRequest;
use App\Http\Requests\Employees\UpdateRoleRequest;

final class RoleController extends Controller
{
    public function store(CreateRoleRequest $request, CreateRole $action): Role
    {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateRoleRequest $request,
        Role $role,
        UpdateRole $action
    ): Role {
        return $action->execute($role, $request->validated());
    }

    public function destroy(Role $role, DeleteRole $action): void
    {
        $action->execute($role);
    }
}