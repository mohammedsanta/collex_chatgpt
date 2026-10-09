<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return ['token' => ['required','string'], 'email' => ['required','email:rfc','max:255'], 'password' => ['required','string','min:12','confirmed','max:255']];
    }
}
