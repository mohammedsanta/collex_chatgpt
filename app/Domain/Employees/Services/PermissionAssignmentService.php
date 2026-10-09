<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class PermissionAssignmentService
{
    public function grantToUser(User $user, int $permissionId): void
    {
        try {
            DB::transaction(function () use ($user, $permissionId) {
                $user->permissions()->syncWithoutDetaching([
                    $permissionId => ['granted' => true],
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to grant user permission.', [
                'user_id' => $user->id,
                'permission_id' => $permissionId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function grantToRole(Role $role, int $permissionId): void
    {
        try {
            DB::transaction(function () use ($role, $permissionId) {
                $role->permissions()->syncWithoutDetaching([
                    $permissionId,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to grant role permission.', [
                'role_id' => $role->id,
                'permission_id' => $permissionId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}