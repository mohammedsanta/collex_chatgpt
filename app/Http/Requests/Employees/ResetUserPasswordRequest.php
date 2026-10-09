<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class ResetUserPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.change_password');
    }

    public function rules(): array
    {
        return [
            'password' => ['required','string','min:12','confirmed','max:255'],
        ];
    }
}
