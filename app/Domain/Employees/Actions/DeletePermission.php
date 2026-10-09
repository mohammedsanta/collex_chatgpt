<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeletePermission
{
    public function execute(Permission $permission): void
    {
        try {
            DB::transaction(function () use ($permission): void {
                $permission = Permission::query()
                    ->lockForUpdate()
                    ->findOrFail($permission->getKey());

                if (
                    $permission->roles()->exists()
                    || $permission->users()->exists()
                ) {
                    throw new \App\Exceptions\DomainException(
                        'A permission assigned to roles or users cannot be deleted.'
                    );
                }

                $permission->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete permission.', [
                'action' => self::class,
                'permission_id' => $permission->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}