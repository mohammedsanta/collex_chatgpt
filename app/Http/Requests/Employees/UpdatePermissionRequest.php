<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('permissions.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes','required','string','max:150','regex:/^[a-z][a-z0-9_]*(\.[a-z][a-z0-9_]*)+$/'], 'label' => ['sometimes','required','string','max:255'], 'group' => ['sometimes','required','string','max:100'],
        ];
    }
}
