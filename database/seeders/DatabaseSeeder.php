<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            GovernorateSeeder::class,
            LoanTypeSeeder::class,
            SettingSeeder::class,
            BankSeeder::class,
            InstallmentCompanySeeder::class,
            UserSeeder::class,
        ]);
    }
}
