<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class AssignPermissionToRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('roles.assign_permission');
    }

    public function rules(): array
    {
        return [
            'permission_id' => ['required','integer','exists:permissions,id'],
        ];
    }
}
