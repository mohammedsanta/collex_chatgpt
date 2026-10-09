<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Database\Seeder;

final class LoanTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['قرض شخصي','قرض سيارة','قرض عقاري','بطاقة ائتمان','تمويل استهلاكي','تمويل مشروعات'] as $name) {
            LoanType::query()->firstOrCreate(['name'=>$name], ['is_active'=>true]);
        }
    }
}
