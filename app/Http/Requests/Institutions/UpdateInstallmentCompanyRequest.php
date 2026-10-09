<?php

declare(strict_types=1);

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateInstallmentCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('installment_companies.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes','required','string','max:255', Rule::unique('installment_companies', 'name')->ignore($this->route('installmentCompany')?->getKey())], 'code' => ['sometimes','required','string','max:30', Rule::unique('installment_companies', 'code')->ignore($this->route('installmentCompany')?->getKey())], 'sector' => ['sometimes','nullable','string','max:100'], 'notes' => ['sometimes','nullable','string','max:5000'], 'is_active' => ['sometimes','boolean'],
        ];
    }
}
