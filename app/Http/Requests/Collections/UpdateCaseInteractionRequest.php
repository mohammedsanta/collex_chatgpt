<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateCaseInteractionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('interactions.update');
    }

    public function rules(): array
    {
        return [
            'client_phone_id' => ['sometimes','nullable','integer','exists:client_phones,id'], 'type' => ['sometimes','required', Rule::in(['call','whatsapp','sms','email','visit','note'])], 'outcome' => ['sometimes','nullable', Rule::in(['answered','no_answer','wrong_number','refused','promised','paid'])], 'notes' => ['sometimes','nullable','string','max:5000'], 'duration_seconds' => ['sometimes','nullable','integer','min:0','max:86400'], 'occurred_at' => ['sometimes','required','date'], 'followup_at' => ['sometimes','nullable','date'],
        ];
    }
}
