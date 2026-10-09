<?php

declare(strict_types=1);

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateGovernorateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('governorates.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes','required','string','max:255', Rule::unique('governorates', 'name')->ignore($this->route('governorate')?->getKey())], 'name_en' => ['sometimes','nullable','string','max:255'],
        ];
    }
}
