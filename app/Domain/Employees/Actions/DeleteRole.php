<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteRole
{
    public function execute(Role $role): void
    {
        try {
            DB::transaction(function () use ($role): void {
                $role = Role::query()
                    ->lockForUpdate()
                    ->findOrFail($role->getKey());

                if ($role->is_system) {
                    throw new \App\Exceptions\DomainException(
                        'System roles cannot be deleted.'
                    );
                }

                if ($role->users()->exists()) {
                    throw new \App\Exceptions\DomainException(
                        'A role assigned to users cannot be deleted.'
                    );
                }

                $role->permissions()->detach();

                $role->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete role.', [
                'action' => self::class,
                'role_id' => $role->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}