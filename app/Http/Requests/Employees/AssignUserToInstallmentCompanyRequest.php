<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class AssignUserToInstallmentCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.update');
    }

    public function rules(): array
    {
        return [
            'installment_company_id' => ['required','integer','exists:installment_companies,id'],
        ];
    }
}
