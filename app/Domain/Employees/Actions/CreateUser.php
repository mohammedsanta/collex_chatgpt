<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateUser
{
    public function execute(array $data): User
    {
        try {
            return DB::transaction(function () use ($data): User {
                return User::create([
                    'employee_code' => $data['employee_code'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'] ?? null,
                    'password' => Hash::make($data['password']),
                    'role_id' => $data['role_id'],
                    'supervisor_id' => $data['supervisor_id'] ?? null,
                    'status' => $data['status'] ?? 'active',
                    'is_system_account' => $data['is_system_account'] ?? false,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create user.', [
                'action' => self::class,
                'employee_code' => $data['employee_code'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}