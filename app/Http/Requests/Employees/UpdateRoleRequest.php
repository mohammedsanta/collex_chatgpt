<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('roles.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes','required','string','max:100','regex:/^[a-z][a-z0-9_-]*$/'], 'label' => ['sometimes','required','string','max:255'], 'description' => ['sometimes','nullable','string','max:5000'], 'level' => ['sometimes','integer','min:0','max:100'],
        ];
    }
}
