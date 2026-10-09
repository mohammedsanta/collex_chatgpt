<?php

declare(strict_types=1);

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateLoanTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('loan_types.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes','required','string','max:255', Rule::unique('loan_types', 'name')->ignore($this->route('loanType')?->getKey())], 'is_active' => ['sometimes','boolean'],
        ];
    }
}
