<?php

declare(strict_types=1);

namespace App\Http\Requests\Customers;

use App\Domain\Customers\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateClientRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('create', Client::class) ?? false; }
    public function rules(): array
    {
        return [
            'national_id' => ['required', 'digits:14', 'unique:clients,national_id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email:rfc', 'max:255'],
            'governorate_id' => ['nullable', 'integer', 'exists:governorates,id'],
            'address' => ['nullable', 'string', 'max:500'],
            'employer_name' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'work_address' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
