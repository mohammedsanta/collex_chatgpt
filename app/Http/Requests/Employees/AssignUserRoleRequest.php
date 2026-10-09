<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class AssignUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.assign_role');
    }

    public function rules(): array
    {
        return [
            'role_id' => ['required','integer','exists:roles,id'],
        ];
    }
}
