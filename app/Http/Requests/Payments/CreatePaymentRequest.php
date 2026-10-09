<?php

declare(strict_types=1);

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePaymentRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('create', \App\Domain\Payments\Models\Payment::class) ?? false; }
    public function rules(): array
    {
        return [
            'debt_case_id' => ['required', 'integer', 'exists:debt_cases,id'],
            'collector_id' => ['nullable', 'integer', 'exists:users,id'],
            'promise_id' => ['nullable', 'integer', 'exists:promises_to_pay,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'decimal:0,2'],
            'method' => ['required', Rule::in(['cash', 'e_wallet', 'bank_transfer', 'card', 'cheque'])],
            'reference' => ['nullable', 'string', 'max:100'],
            'proof_path' => ['nullable', 'string', 'max:255'],
            'paid_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
