<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreatePermission
{
    public function execute(array $data): Permission
    {
        try {
            return DB::transaction(function () use ($data): Permission {
                return Permission::create([
                    'name' => $data['name'],
                    'label' => $data['label'],
                    'group' => $data['group'],
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create permission.', [
                'action' => self::class,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}