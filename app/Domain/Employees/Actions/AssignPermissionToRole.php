<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignPermissionToRole
{
    public function execute(Role $role, Permission $permission): void
    {
        try {
            DB::transaction(function () use ($role, $permission): void {
                $role = Role::query()
                    ->lockForUpdate()
                    ->findOrFail($role->getKey());

                $permission = Permission::query()
                    ->findOrFail($permission->getKey());

                DB::table('permission_role')->insertOrIgnore([
                    'role_id' => $role->getKey(),
                    'permission_id' => $permission->getKey(),
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign permission to role.', [
                'action' => self::class,
                'role_id' => $role->getKey(),
                'permission_id' => $permission->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}