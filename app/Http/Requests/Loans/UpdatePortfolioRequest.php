<?php

declare(strict_types=1);

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

final class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('portfolios.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes','required','string','max:255'], 'period_year' => ['sometimes','required','integer','min:2000','max:2200'], 'period_month' => ['sometimes','required','integer','between:1,12'], 'notes' => ['sometimes','nullable','string','max:5000'],
        ];
    }
}
