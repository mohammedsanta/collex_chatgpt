<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes','required','string','max:255'], 'email' => ['sometimes','required','email:rfc','max:255', Rule::unique('users', 'email')->ignore($this->route('user')?->getKey())], 'phone' => ['sometimes','nullable','string','max:20', Rule::unique('users', 'phone')->ignore($this->route('user')?->getKey())], 'role_id' => ['sometimes','required','integer','exists:roles,id'], 'supervisor_id' => ['sometimes','nullable','integer','exists:users,id'], 'status' => ['sometimes', Rule::in(['active','inactive','suspended'])],
        ];
    }
}
