<?php

declare(strict_types=1);

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class AddClientPhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('clients.update');
    }

    public function rules(): array
    {
        return [
            'phone' => ['required','string','max:20'], 'label' => ['sometimes', Rule::in(['primary','alternate','work','other'])],
        ];
    }
}
