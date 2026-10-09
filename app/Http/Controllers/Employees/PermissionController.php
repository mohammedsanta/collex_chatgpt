<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\CreatePermission;
use App\Domain\Employees\Actions\DeletePermission;
use App\Domain\Employees\Actions\UpdatePermission;
use App\Domain\Employees\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreatePermissionRequest;
use App\Http\Requests\Employees\UpdatePermissionRequest;

final class PermissionController extends Controller
{
    public function store(CreatePermissionRequest $request, CreatePermission $action): Permission
    {
        return $action->execute($request->validated());
    }

    public function update(
        UpdatePermissionRequest $request,
        Permission $permission,
        UpdatePermission $action
    ): Permission {
        return $action->execute($permission, $request->validated());
    }

    public function destroy(Permission $permission, DeletePermission $action): void
    {
        $action->execute($permission);
    }

    public function index()
    {
        $permissions = Permission::query()
            ->orderBy('group')
            ->orderBy('label')
            ->paginate(25);

        return view('permissions.index', compact('permissions'));
    }
}