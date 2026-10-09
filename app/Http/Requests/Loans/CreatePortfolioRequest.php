<?php

declare(strict_types=1);

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

final class CreatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('portfolios.create');
    }

    public function rules(): array
    {
        return [
            'bank_id' => ['required','integer','exists:banks,id'], 'name' => ['required','string','max:255'], 'period_year' => ['required','integer','min:2000','max:2200'], 'period_month' => ['required','integer','between:1,12'], 'notes' => ['nullable','string','max:5000'],
        ];
    }
}
