<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\CreateRole;
use App\Domain\Employees\Actions\DeleteRole;
use App\Domain\Employees\Actions\UpdateRole;
use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
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

    // 
    public function index()
    {
        $roles = Role::query()
            ->withCount(['users', 'permissions'])
            ->orderByDesc('level')
            ->orderBy('label')
            ->paginate(15);

        $stats = [
            'total' => Role::count(),
            'system' => Role::where('is_system', true)->count(),
            'custom' => Role::where('is_system', false)->count(),
            'users' => User::count(),
        ];

        $permissions = Permission::query()
            ->orderBy('group')
            ->orderBy('label')
            ->get();

        return view('roles.index', compact(
            'roles',
            'stats',
            'permissions'
        ));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function edit(Role $role)
    {
        $role->load('permissions');

        $permissions = Permission::query()
            ->orderBy('group')
            ->orderBy('label')
            ->get()
            ->groupBy('group');

        return view('roles.edit', compact('role', 'permissions'));
    }


    
}