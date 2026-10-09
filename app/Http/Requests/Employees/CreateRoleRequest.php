<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class CreateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('roles.create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:100','regex:/^[a-z][a-z0-9_-]*$/','unique:roles,name'], 'label' => ['required','string','max:255'], 'description' => ['nullable','string','max:5000'], 'level' => ['sometimes','integer','min:0','max:100'],
        ];
    }
}
