<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class CreatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('permissions.create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:150','unique:permissions,name','regex:/^[a-z][a-z0-9_]*(\.[a-z][a-z0-9_]*)+$/'], 'label' => ['required','string','max:255'], 'group' => ['required','string','max:100'],
        ];
    }
}
