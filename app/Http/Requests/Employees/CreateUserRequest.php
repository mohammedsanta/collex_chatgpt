<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.create');
    }

    public function rules(): array
    {
        return [
            'employee_code' => ['required','string','max:30','unique:users,employee_code'], 'name' => ['required','string','max:255'], 'email' => ['required','email:rfc','max:255','unique:users,email'], 'phone' => ['nullable','string','max:20','unique:users,phone'], 'password' => ['required','string','min:12','confirmed','max:255'], 'role_id' => ['required','integer','exists:roles,id'], 'supervisor_id' => ['nullable','integer','exists:users,id'], 'status' => ['sometimes', Rule::in(['active','inactive','suspended'])],
        ];
    }
}
