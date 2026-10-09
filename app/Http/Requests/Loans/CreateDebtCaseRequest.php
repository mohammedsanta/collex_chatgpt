<?php

declare(strict_types=1);

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateDebtCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('debt_cases.create');
    }

    public function rules(): array
    {
        return [
            'portfolio_id' => ['required','integer','exists:portfolios,id'],
             'bank_id' => ['required','integer','exists:banks,id'],
              'client_id' => ['required','integer','exists:clients,id'],
               'loan_type_id' => ['nullable','integer','exists:loan_types,id'],
                'assigned_user_id' => ['nullable','integer','exists:users,id'],
                 'loan_number' => ['nullable','string','max:100'],
                  'status' => ['sometimes', Rule::in(['active','inactive','paid','legal'])],
                   'total_debt' => ['required','numeric','gt:0','decimal:0,2'],
                    'overdue_amount' => ['sometimes','numeric','min:0','decimal:0,2'],
                     'installment_value' => ['nullable','numeric','min:0','decimal:0,2'],
                      'min_installment_diff' => ['nullable','numeric','min:0','decimal:0,2'],
                       'late_fee' => ['sometimes','numeric','min:0','decimal:0,2'],
                        'bucket' => ['nullable','string','max:30'],
                         'dpd' => ['sometimes','integer','min:0'],
                          'next_due_date' => ['nullable','date'],
                           'loan_start_date' => ['nullable','date'],
                            'loan_end_date' => ['nullable','date','after_or_equal:loan_start_date'],
        ];
    }
}
