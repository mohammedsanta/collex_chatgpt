<?php

declare(strict_types=1);

namespace App\Http\Requests\Loans;

use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Foundation\Http\FormRequest;

final class CreatePortfolioImportRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('create', PortfolioImport::class) ?? false; }
    public function rules(): array
    {
        return [
            'portfolio_id' => ['required', 'integer', 'exists:portfolios,id'],
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:20480'],
        ];
    }
}
