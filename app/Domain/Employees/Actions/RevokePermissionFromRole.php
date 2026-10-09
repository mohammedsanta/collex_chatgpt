<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RevokePermissionFromRole
{
    public function execute(Role $role, Permission $permission): Role
    {
        try {
            return DB::transaction(function () use ($role, $permission): Role {
                DB::table('permission_role')
                    ->where('role_id', $role->getKey())
                    ->where('permission_id', $permission->getKey())
                    ->delete();

                return $role->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to revoke permission from role.', [
                'action' => self::class,
                'role_id' => $role->getKey(),
                'permission_id' => $permission->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}