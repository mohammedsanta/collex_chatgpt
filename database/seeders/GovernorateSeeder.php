<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Database\Seeder;

final class GovernorateSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['القاهرة','الجيزة','الإسكندرية','الدقهلية','البحر الأحمر','البحيرة','الفيوم','الغربية','الإسماعيلية','المنوفية','المنيا','القليوبية','الوادي الجديد','السويس','أسوان','أسيوط','بني سويف','بورسعيد','دمياط','الشرقية','جنوب سيناء','كفر الشيخ','مطروح','الأقصر','قنا','شمال سيناء','سوهاج'];
        foreach ($names as $name) { Governorate::query()->firstOrCreate(['name'=>$name]); }
    }
}
