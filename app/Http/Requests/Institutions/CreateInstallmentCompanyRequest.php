<?php

declare(strict_types=1);

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;

final class CreateInstallmentCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('installment_companies.create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255','unique:installment_companies,name'], 'code' => ['required','string','max:30','unique:installment_companies,code'], 'sector' => ['nullable','string','max:100'], 'notes' => ['nullable','string','max:5000'], 'is_active' => ['sometimes','boolean'],
        ];
    }
}
