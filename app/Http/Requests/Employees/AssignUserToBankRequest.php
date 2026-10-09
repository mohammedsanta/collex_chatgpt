<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class AssignUserToBankRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.update');
    }

    public function rules(): array
    {
        return [
            'bank_id' => ['required','integer','exists:banks,id'],
        ];
    }
}
