<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

final class UserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('COLLEX_ADMIN_EMAIL');
        $password = env('COLLEX_ADMIN_PASSWORD');
        if (! $email && ! $password) {
            return;
        }
        if (! $email || ! $password || strlen((string) $password) < 14) {
            throw new RuntimeException('Set both COLLEX_ADMIN_EMAIL and COLLEX_ADMIN_PASSWORD (at least 14 characters) to create the initial administrator.');
        }

        $role = Role::query()->where('name', 'super_admin')->firstOrFail();
        User::query()->updateOrCreate(['email' => $email], [
            'employee_code' => 'SYS-ADMIN',
            'name' => 'System Administrator',
            'password' => Hash::make($password),
            'role_id' => $role->id,
            'status' => 'active',
            'is_system_account' => true,
        ]);
    }
}
