<?php

declare(strict_types=1);

namespace App\Http\Requests\Customers;

use App\Domain\Customers\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('update', $this->route('client')) ?? false; }
    public function rules(): array
    {
        $clientId = $this->route('client')?->getKey();
        return [
            'national_id' => ['sometimes', 'required', 'digits:14', Rule::unique('clients', 'national_id')->ignore($clientId)],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'nullable', 'email:rfc', 'max:255'],
            'governorate_id' => ['sometimes', 'nullable', 'integer', 'exists:governorates,id'],
            'address' => ['sometimes', 'nullable', 'string', 'max:500'],
            'employer_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'job_title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'work_address' => ['sometimes', 'nullable', 'string', 'max:500'],
            'notes' => ['sometimes', 'nullable', 'string', 'max:5000'],
        ];
    }
}
