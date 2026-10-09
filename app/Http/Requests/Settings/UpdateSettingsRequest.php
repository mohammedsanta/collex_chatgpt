<?php

declare(strict_types=1);

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null && $this->user()->hasPermission('settings.manage'); }
    public function rules(): array { return ['settings' => ['required','array','min:1'], 'settings.*' => ['nullable','string','max:5000']]; }
}
