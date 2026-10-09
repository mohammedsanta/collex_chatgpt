<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateRole
{
    /** @param array<string, mixed> $data */
    public function execute(array $data): Role
    {
        try {
            return DB::transaction(fn (): Role => Role::query()->create([
                'name' => $data['name'], 'label' => $data['label'],
                'description' => $data['description'] ?? null,
                'is_system' => false, 'level' => (int) ($data['level'] ?? 0),
            ]));
        } catch (Throwable $exception) {
            Log::error('Failed to create role.', ['exception' => $exception]);
            throw $exception;
        }
    }
}
