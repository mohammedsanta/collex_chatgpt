<?php

declare(strict_types=1);

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateClientPhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('clients.update');
    }

    public function rules(): array
    {
        return [
            'phone' => ['sometimes','required','string','max:20'], 'label' => ['sometimes', Rule::in(['primary','alternate','work','other'])], 'is_valid' => ['sometimes','boolean'],
        ];
    }
}
