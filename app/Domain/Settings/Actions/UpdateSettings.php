<?php

declare(strict_types=1);

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;
use App\Domain\Settings\Services\SettingService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateSettings
{
    public function __construct(private readonly SettingService $settingService) {}

    /** @param array<string, mixed> $data */
    public function execute(array $data): int
    {
        try {
            return DB::transaction(function () use ($data): int {
                $count = 0;
                foreach (($data['settings'] ?? []) as $key => $value) {
                    $setting = Setting::query()->where('key', $key)->firstOrFail();
                    $typedValue = match ($setting->type) {
                        'boolean' => filter_var($value, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE) ?? throw new \InvalidArgumentException("Setting {$setting->key} must be boolean."),
                        'integer' => filter_var($value, FILTER_VALIDATE_INT) !== false ? (int) $value : throw new \InvalidArgumentException("Setting {$setting->key} must be an integer."),
                        'float' => is_numeric($value) ? (float) $value : throw new \InvalidArgumentException("Setting {$setting->key} must be numeric."),
                        'json', 'array' => is_string($value) ? json_decode($value, true, flags: JSON_THROW_ON_ERROR) : $value,
                        default => $value,
                    };
                    $this->settingService->set($setting->key, $typedValue, $setting->group, $setting->is_public);
                    $count++;
                }
                return $count;
            });
        } catch (Throwable $exception) {
            Log::error('Failed to update application settings.', ['keys' => array_keys($data['settings'] ?? []), 'exception' => $exception]);
            throw $exception;
        }
    }
}
