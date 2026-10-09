<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class AssignUserToSupervisorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.assign_supervisor');
    }

    public function rules(): array
    {
        return [
            'supervisor_id' => ['nullable','integer','different:user_id','exists:users,id'],
        ];
    }
}
