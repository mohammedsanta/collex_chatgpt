<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\Settings\Models\Setting;
use Illuminate\Database\Seeder;

final class SettingSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([['key'=>'currency','value'=>'EGP','type'=>'string','group'=>'general','is_public'=>true],['key'=>'default_locale','value'=>'ar','type'=>'string','group'=>'general','is_public'=>true],['key'=>'payment_confirmation_required','value'=>'true','type'=>'boolean','group'=>'payments','is_public'=>false]] as $setting) {
            Setting::query()->updateOrCreate(['key'=>$setting['key']], $setting);
        }
    }
}
