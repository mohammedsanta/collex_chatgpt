<?php

declare(strict_types=1);

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;

final class CreateGovernorateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('governorates.create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255','unique:governorates,name'], 'name_en' => ['nullable','string','max:255'],
        ];
    }
}
