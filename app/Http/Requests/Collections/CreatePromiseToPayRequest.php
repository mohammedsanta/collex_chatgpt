<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class CreatePromiseToPayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('promises.create');
    }

    public function rules(): array
    {
        return [
            'debt_case_id' => ['required','integer','exists:debt_cases,id'], 'promised_amount' => ['required','numeric','gt:0','decimal:0,2'], 'promise_date' => ['required','date'], 'notes' => ['nullable','string','max:5000'],
        ];
    }
}
