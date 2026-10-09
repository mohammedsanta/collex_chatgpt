<?php

declare(strict_types=1);

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

final class AssignCollectorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('debt_cases.assign');
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required','integer','exists:users,id'], 'reason' => ['nullable','string','max:500'],
        ];
    }
}
