<?php

declare(strict_types=1);

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;

final class CreateLoanTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('loan_types.create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255','unique:loan_types,name'], 'is_active' => ['sometimes','boolean'],
        ];
    }
}
