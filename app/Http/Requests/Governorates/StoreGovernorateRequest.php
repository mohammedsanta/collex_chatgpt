<?php

declare(strict_types=1);

namespace App\Http\Requests\Governorates;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreGovernorateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('governorates', 'name'),
            ],
            'name_en' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('governorates', 'name_en'),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم المحافظة بالعربية',
            'name_en' => 'اسم المحافظة بالإنجليزية',
        ];
    }
}
