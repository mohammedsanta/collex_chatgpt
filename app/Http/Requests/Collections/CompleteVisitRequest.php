<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CompleteVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('visits.complete');
    }

    public function rules(): array
    {
        return [
            'outcome' => ['required', Rule::in(['client_found','not_home','refused','promised','paid'])], 'visited_at' => ['nullable','date'], 'notes' => ['nullable','string','max:5000'],
        ];
    }
}
