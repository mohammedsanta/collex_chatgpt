<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('complaints.update');
    }

    public function rules(): array
    {
        return [
            'bank_id' => ['sometimes','required','integer','exists:banks,id'], 'debt_case_id' => ['sometimes','nullable','integer','exists:debt_cases,id'], 'client_id' => ['sometimes','nullable','integer','exists:clients,id'], 'subject' => ['sometimes','required','string','max:255'], 'description' => ['sometimes','required','string','max:10000'], 'source' => ['sometimes','nullable', Rule::in(['phone','whatsapp','email','bank','visit'])], 'priority' => ['sometimes', Rule::in(['low','medium','high','urgent'])], 'due_at' => ['sometimes','nullable','date'],
        ];
    }
}
