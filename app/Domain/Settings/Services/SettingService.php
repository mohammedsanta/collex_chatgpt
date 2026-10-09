<?php

declare(strict_types=1);

namespace App\Domain\Settings\Services;

use App\Domain\Settings\Models\Setting;

final class SettingService
{
    public function get(string $key, mixed $default = null): mixed
    {
        $setting = Setting::query()->where('key', $key)->first();
        return $setting === null ? $default : $setting->typed_value;
    }

    public function set(string $key, mixed $value, string $group = 'general', bool $isPublic = false): Setting
    {
        [$type, $serialized] = $this->serializeValue($value);
        return Setting::query()->updateOrCreate(['key' => $key], ['value' => $serialized, 'type' => $type, 'group' => $group, 'is_public' => $isPublic]);
    }

    /** @return array<string, mixed> */
    public function publicSettings(): array
    {
        return Setting::query()->where('is_public', true)->orderBy('group')->orderBy('key')->get()->mapWithKeys(fn (Setting $setting) => [$setting->key => $setting->typed_value])->all();
    }

    /** @return array{0: string, 1: string} */
    private function serializeValue(mixed $value): array
    {
        if (is_bool($value)) { return ['boolean', $value ? 'true' : 'false']; }
        if (is_int($value)) { return ['integer', (string) $value]; }
        if (is_float($value)) { return ['float', (string) $value]; }
        if (is_array($value)) { return ['json', json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE)]; }
        return ['string', (string) $value];
    }
}
