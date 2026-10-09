<?php

declare(strict_types=1);

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

final class ChangeUserPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('users.change_password');
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required','current_password'], 'password' => ['required','string','min:12','confirmed','max:255'],
        ];
    }
}
