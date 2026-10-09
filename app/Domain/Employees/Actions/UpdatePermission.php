<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePermission
{
    public function execute(
        Permission $permission,
        array $data
    ): Permission {
        try {
            return DB::transaction(function () use (
                $permission,
                $data
            ): Permission {
                $permission = Permission::query()
                    ->lockForUpdate()
                    ->findOrFail($permission->getKey());

                $updates = array_intersect_key(
                    $data,
                    array_flip([
                        'name',
                        'label',
                        'group',
                    ])
                );

                $permission->update($updates);

                return $permission->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update permission.', [
                'action' => self::class,
                'permission_id' => $permission->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}