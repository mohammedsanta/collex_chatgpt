<?php

declare(strict_types=1);

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;

final class CreateBankRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('banks.create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255','unique:banks,name'], 'code' => ['required','string','max:30','unique:banks,code'], 'sector' => ['nullable','string','max:100'], 'notes' => ['nullable','string','max:5000'], 'is_active' => ['sometimes','boolean'],
        ];
    }
}
