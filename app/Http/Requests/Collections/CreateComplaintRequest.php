<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('complaints.create');
    }

    public function rules(): array
    {
        return [
            'bank_id' => ['required','integer','exists:banks,id'], 'debt_case_id' => ['nullable','integer','exists:debt_cases,id'], 'client_id' => ['nullable','integer','exists:clients,id'], 'subject' => ['required','string','max:255'], 'description' => ['required','string','max:10000'], 'source' => ['nullable', Rule::in(['phone','whatsapp','email','bank','visit'])], 'priority' => ['sometimes', Rule::in(['low','medium','high','urgent'])], 'due_at' => ['nullable','date'],
        ];
    }
}
