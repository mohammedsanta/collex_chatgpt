<?php

declare(strict_types=1);

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateDebtCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('debt_cases.update');
    }

    public function rules(): array
    {
        return [
            'loan_type_id' => ['sometimes','nullable','integer','exists:loan_types,id'], 'loan_number' => ['sometimes','nullable','string','max:100'], 'status' => ['sometimes', Rule::in(['active','inactive','paid','legal'])], 'total_debt' => ['sometimes','required','numeric','gt:0','decimal:0,2'], 'overdue_amount' => ['sometimes','numeric','min:0','decimal:0,2'], 'installment_value' => ['sometimes','nullable','numeric','min:0','decimal:0,2'], 'min_installment_diff' => ['sometimes','nullable','numeric','min:0','decimal:0,2'], 'late_fee' => ['sometimes','numeric','min:0','decimal:0,2'], 'bucket' => ['sometimes','nullable','string','max:30'], 'dpd' => ['sometimes','integer','min:0'], 'next_due_date' => ['sometimes','nullable','date'], 'loan_start_date' => ['sometimes','nullable','date'], 'loan_end_date' => ['sometimes','nullable','date','after_or_equal:loan_start_date'],
        ];
    }
}
