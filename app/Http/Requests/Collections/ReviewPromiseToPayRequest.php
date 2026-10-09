<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ReviewPromiseToPayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('promises.review');
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['kept','partial','broken'])], 'notes' => ['nullable','string','max:5000'],
        ];
    }
}
