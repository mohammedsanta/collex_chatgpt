<?php

declare(strict_types=1);

namespace App\Http\Requests\Governorates;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateGovernorateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $governorate = $this->route('governorate');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('governorates', 'name')
                    ->ignore($governorate),
            ],
            'name_en' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('governorates', 'name_en')
                    ->ignore($governorate),
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
