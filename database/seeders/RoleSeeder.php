<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\Employees\Models\Role;
use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name'=>'super_admin','label'=>'مدير النظام','level'=>100],
            ['name'=>'admin','label'=>'مدير','level'=>80],
            ['name'=>'supervisor','label'=>'مشرف تحصيل','level'=>50],
            ['name'=>'collector','label'=>'محصل','level'=>20],
            ['name'=>'auditor','label'=>'مراجع','level'=>40],
        ] as $role) {
            Role::query()->updateOrCreate(['name'=>$role['name']], $role + ['is_system'=>true]);
        }
    }
}
