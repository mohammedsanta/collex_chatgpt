<?php

declare(strict_types=1);

namespace App\Http\Requests\Payments;

use App\Domain\Payments\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdatePaymentRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('update', $this->route('payment')) ?? false; }
    public function rules(): array
    {
        return [
            'debt_case_id' => ['sometimes','required','integer','exists:debt_cases,id'],
            'collector_id' => ['sometimes','nullable','integer','exists:users,id'],
            'promise_id' => ['sometimes','nullable','integer','exists:promises_to_pay,id'],
            'amount' => ['sometimes','required','numeric','gt:0','decimal:0,2'],
            'method' => ['sometimes','required',Rule::in(['cash','e_wallet','bank_transfer','card','cheque'])],
            'reference' => ['sometimes','nullable','string','max:100'],
            'proof_path' => ['sometimes','nullable','string','max:255'],
            'paid_at' => ['sometimes','required','date'],
            'notes' => ['sometimes','nullable','string','max:5000'],
        ];
    }
}
