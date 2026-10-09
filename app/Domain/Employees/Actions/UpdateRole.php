<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Role;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateRole
{
    /** @param array<string, mixed> $data */
    public function execute(Role $role, array $data): Role
    {
        try {
            return DB::transaction(function () use ($role, $data): Role {
                $locked = Role::query()->lockForUpdate()->findOrFail($role->getKey());
                if ($locked->is_system) {
                    throw new DomainException('System roles cannot be edited.', 'SYSTEM_ROLE_IMMUTABLE');
                }
                $locked->update(array_intersect_key($data, array_flip(['name','label','description','level'])));
                return $locked->refresh();
            });
        } catch (Throwable $exception) {
            Log::error('Failed to update role.', ['role_id' => $role->getKey(), 'exception' => $exception]);
            throw $exception;
        }
    }
}
