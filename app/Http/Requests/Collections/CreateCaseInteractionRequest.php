<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateCaseInteractionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('interactions.create');
    }

    public function rules(): array
    {
        return [
            'debt_case_id' => ['required','integer','exists:debt_cases,id'], 'client_phone_id' => ['nullable','integer','exists:client_phones,id'], 'type' => ['required', Rule::in(['call','whatsapp','sms','email','visit','note'])], 'outcome' => ['nullable', Rule::in(['answered','no_answer','wrong_number','refused','promised','paid'])], 'notes' => ['nullable','string','max:5000'], 'duration_seconds' => ['nullable','integer','min:0','max:86400'], 'occurred_at' => ['required','date'], 'followup_at' => ['nullable','date','after_or_equal:occurred_at'],
        ];
    }
}
